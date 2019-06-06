<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CollectionRequest;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Auth::user()->collections()->get();
        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectionRequest $request)
    {
        $collection = Auth::user()->collections()->create($request->validated());
        return redirect()->route('collections.index')->with('message', __('app.collection.messages.add', ['collection' => $collection->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        $collection->load('books');
        return view('collections.show', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        $books = Book::all();
        return view('collections.edit', compact('collection', 'books'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(CollectionRequest $request, Collection $collection)
    {
        $data = $request->all();
        if(!empty($data['books']))
        {
            $collection->books()->sync($data['books']);
            unset($data['books']);
        }
        else {
            $collection->books()->detach();
        }
        
        if($collection->update($data))
            return redirect()->route('collections.index')->with('message', __('app.collection.messages.update', ['collection' => $collection->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        if($collection->delete())
            return redirect()->route('collections.index')->with('message', __('app.collection.messages.delete', ['collection' => $collection->name]));;
    }
}
