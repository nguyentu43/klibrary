@extends("layouts.main")

@section("main")
    <div class="card">
        <div class="card-header">
            @lang('app.collection.create')
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('collections.store') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">@lang('app.collection.name')</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" required class="form-control @error('name') is-invalid  @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="offset-sm-2 col-sm-10">
                    <button class="btn btn-primary" type="submit">@lang('app.collection.create')</button>
                </div>
            </form>
        </div>
    </div>
@endsection