<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\EbookConvert;
use App\EbookMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Jobs\{ ConvertFormat, SendToKindle };

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $ebookMeta;

    public function __construct(EbookMeta $ebookMeta)
    {
        $this->ebookMeta = $ebookMeta;
    }
    
    public function index(Request $request)
    {

        if($request->get('show') === 'trashed')
        {
            $books = Auth::user()->books()->onlyTrashed()->paginate(1);
            $show = $request->get('show');
        }
        else {
            $books = Auth::user()->books()->paginate(10);
        }
        return view('books.index', compact('books', 'show'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ebook' => 'required|max:19000|file|ebooktypes'
        ]);
        $ebookFile = $request->ebook;
        $book = Auth::user()->books()->create([]);
        $book->formats = [ $ebookFile->getClientOriginalExtension() ];
        $filename = $book->id.".".$ebookFile->getClientOriginalExtension();
        $bookPath = storage_path('app/ebooks')."/".$filename;
        $ebookFile->storeAs('ebooks', $filename);
        $data = $this->ebookMeta->read($bookPath, $book->id);
        if(array_key_exists('date', $data))
            $data['date'] = Carbon::createFromFormat('Y-m-d\TH:i:sP', $data['date'])->format('Y-m-d H:i:s');
        if(array_key_exists('comments', $data))
            $data['comments'] = utf8_decode($data['comments']);
        $book->fill($data);
        $book->save();

        return redirect()->route('books.index')->with('message', __('app.book.messages.add', ['book' => $book->title]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Book $book)
    {
        $this->authorize('view', $book);

        if($request->filled('download'))
        {
            return Storage::download('ebooks/'.$book->id.'.'.$request->get('download'), $book->title.'.'.$request->get('download'));
        }
        else if($request->filled('delete'))
        {
            $format = $request->get('delete');
            if($book->format[0] !== $format)
            {
                Storage::delete(['ebooks/'.$book->id.'.'.$format]);
                $book->formats = array_filter($book->formats, function($item) use($format){
                    return $item !== $format;
                });
                $book->save();
            }   
        }
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $this->authorize('view', $book);
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $request->validate([
            'cover' => 'nullable|max:1024|mimes:jpg',
            'title' => 'required'
        ]);

        if($request->cover)
        {
            $request->cover->storeAs('public/covers', $book->id.".jpg");
            $book->cover = true;
        }
        $data = $request->input();
        unset($data['cover']);

        foreach($book->formats as $format)
        {
            $this->ebookMeta->write(storage_path('app/ebooks/'.$book->id.'.'.$format), $book->toArray());
        }
        if($book->update($data))
            return redirect()->route('books.show', ['book' => $book ])->with('message', __('app.book.messages.update', ['book' => $book->title ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('delete', $book);

        $book = Book::withTrashed()->findOrFail($id);
        if($book->trashed())
        {
            if($book->forceDelete())
                return redirect()->route('books.index')->with('message',  __('app.book.messages.delete', ['book' => $book->title ]));
        }
        else {
            if($book->delete())
                return redirect()->route('books.index')->with('message', __('app.book.messages.trash', ['book' => $book->title ]));
        }
    }

    public function restore(Request $request, $id)
    {
        $this->authorize('delete', $book);

        $book = Book::onlyTrashed()->findOrFail($id);
        $book->restore();
        return redirect()->route('books.index')->with('message',  __('app.book.messages.restore', ['book' => $book->title ]));
    }

    public function convert(Request $request, Book $book)
    {
        $this->authorize('view', $book);
        if($request->has('format'))
        {
            $device = Auth::user()->devices()->where('default', 1)->first();
            $profile = $device ? $device->type: 'default';
            ConvertFormat::dispatch($book, $request->get('format'), $profile);
            return redirect()->route('books.show', ['book' => $book])->with('message', __('app.book.messages.convert'));
        }
        return redirect()->route('books.show', ['book' => $book])->with('formatConvertError', __('app.book.error.convert', [ 'formats' => implode(', ', EbookConvert::$supportTypes)]));
    }

    public function send(Request $request, Book $book)
    {
        $this->authorize('view', $book);
        $request->validate([
            'email_to' => 'required|email',
            'email_from' => 'required|email',
            'format' => 'required|in:'.implode(',', EbookConvert::$supportTypes)
        ]);
        SendToKindle::dispatch($book, $request->only(['email_to', 'email_from', 'format']));
        return redirect()->route('books.show', compact('book'))->with('message', __('app.book.sent'));
    }
}
