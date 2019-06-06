@extends('layouts.main')

@section('main')
<div class="card">
        <div class="card-header">
            @lang('app.collection.edit')
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('collections.update', compact('collection')) }}">
                @csrf
                @method("PATCH")
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">@lang('app.collection.name')</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" required class="form-control @error('name') is-invalid  @enderror" value="{{ $collection->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="booksDropdown" class="col-sm-2 col-form-label">@lang('app.collection.books')</label>
                    <div class="col-sm-10">
                        <select id="booksDropdown" name="books[]" multiple>
                            @php
                                $selectedBooks = $collection->books()->get()->pluck('id')->all();
                            @endphp
                            @foreach($books as $book)
                                <option
                                @if(in_array($book->id, $selectedBooks))
                                    selected
                                @endif
                                data-img-src="{{ asset('storage/covers/'.$book->id.'.jpg') }}"
                                value="{{ $book->id }}">
                                    {{ $book->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="offset-sm-2 col-sm-10">
                    <button class="btn btn-primary" type="submit">@lang('app.collection.update')</button>
                </div>
            </form>
        </div>
    </div>
@endsection