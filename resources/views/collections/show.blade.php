@extends('layouts.main')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>@lang('app.collection.title', ['collection' => $collection->name ])</h2>
                <a href="{{ route('collections.edit', compact('collection')) }}" class="mr-1 btn btn-success">@lang('app.collection.edit')</a>
                <form method="post" class="d-inline" action="{{ route('collections.destroy', compact('collection')) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btnDelete" type="submit">@lang('app.collection.delete')</button>
                </form>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <h3>@lang('app.collection.list_book')</h3>
            </div>
            @each("components.book", $collection->books, "book", "components.empty-book")
        </div>
    </div>
@endsection