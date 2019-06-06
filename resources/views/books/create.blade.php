@extends("layouts.main")

@section("main")
    <div class="card">
        <div class="card-header">
            @lang('app.book.upload')
        </div>
        <div class="card-body">
            @error('ebook')
                <div class="alert alert-warning" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <form method="post" action="{{ route('books.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" id="inputEbook" name="ebook">
                <br/>
                <button class="btn btn-primary mt-2">@lang('app.book.upload')</button>
            </form>
        </div>
    </div>
@endsection