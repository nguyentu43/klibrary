@extends("layouts.main")

@section("main")
    <div class="card">
        <div class="card-header">
            {{ __('Upload your book') }}
        </div>
        <div class="card-body">
            @error('ebook')
                <div class="alert alert-warning" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <form method="post" action="{{ route('books.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup">{{ __('Upload') }}</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputEbook" name="ebook"
                        aria-describedby="inputGroupFile">
                        <label class="custom-file-label" for="inputGroup">{{ __('Choose file') }}</label>
                    </div>
                </div>
                <button class="btn btn-primary mt-1">{{ __('OK') }}</button>
            </form>
        </div>
    </div>
@endsection