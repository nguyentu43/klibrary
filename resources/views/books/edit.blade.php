@extends("layouts.main")

@section("main")
    <div class="card">
        <div class="card-header">
            @lang('app.book.edit')
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('books.update', compact('book')) }}">
                @csrf
                @method("PATCH")
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">@lang('app.book.title')</label>
                    <div class="col-sm-10">
                        <input type="text" id="title" name="title" required class="form-control @error('title') is-invalid  @enderror" value="{{ $book->title }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="authors" class="col-sm-2 col-form-label">@lang('app.book.authors')</label>
                    <div class="col-sm-10">
                        <input name="authors" id="authors" type="text" class="form-control" value="{{ $book->authors }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="identifiers" class="col-sm-2 col-form-label">@lang('app.book.identifier')</label>
                    <div class="col-sm-10">
                        <input name="identifier" id="identifiers" type="text" class="form-control" value="{{ $book->identifier }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tags" class="col-sm-2 col-form-label">@lang('app.book.tags')</label>
                    <div class="col-sm-10">
                        <input type="text" name="tags" id="tags" class="form-control" value="{{ $book->tags }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="publisher" class="col-sm-2 col-form-label">@lang('app.book.publisher')</label>
                    <div class="col-sm-10">
                        <input type="text" name="publisher" id="publisher" class="form-control" value="{{ $book->publisher }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="language" class="col-sm-2 col-form-label">@lang('app.book.language')</label>
                    <div class="col-sm-10">
                        <input type="text" name="language" id="language" class="form-control" value="{{ $book->language }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label">@lang('app.book.pubdate')</label>
                    <div class="col-sm-10">
                        <input type="datetime" name="date" id="date" class="form-control" value="{{ $book->date }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="comments" class="col-sm-2 col-form-label">@lang('app.book.comments')</label>
                    <div class="col-sm-10">
                        <textarea id="comments" name="comments" class="form-control">{{ $book->comments }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cover" class="col-sm-2 col-form-label">@lang('app.book.cover')</label>
                    <div class="col-sm-10">
                        <input type="file" name="cover" id="cover">
                        @error('cover')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @if($book->cover)
                            <div class="col-sm-3 mt-2">
                                @component('components.cover', compact('book'))
                                @endcomponent
                            </div>
                        @endif
                    </div>
                </div>

                <div class="offset-sm-2 col-sm-10">
                    <button class="btn btn-primary" type="submit">@lang('app.book.update')</button>
                </div>
            </form>
        </div>
    </div>
@endsection