<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\EbookConvert;
use App\EbookMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Auth::user()->books()->paginate(10);
        return view('books.index', compact('books'));
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
            'ebook' => 'required|max:25600|file|ebooktypes'
        ]);

        $ebookFile = $request->ebook;
        $book = Auth::user()->books()->create([]);
        $book->formats = [ $ebookFile->getClientOriginalExtension() ];
        $filename = $book->id.".".$ebookFile->getClientOriginalExtension();
        $bookPath = storage_path('app/ebooks')."/".$filename;
        $ebookFile->storeAs('ebooks', $filename);
        $data = EbookMeta::read($bookPath, $book->id);
        if(array_key_exists('pubdate', $data))
            $data['pubdate'] = Carbon::createFromFormat('Y-m-d\TH:i:sP', $data['pubdate'])->format('Y-m-d H:i:s');
        if(array_key_exists('comments', $data))
            $data['comments'] = utf8_decode($data['comments']);
        $book->fill($data);
        $book->save();

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Book $book)
    {
        if($request->get('download'))
        {
            return Storage::download('ebooks/'.$book->id.'.'.$request->get('download'), $book->title.'.'.$request->get('download'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
