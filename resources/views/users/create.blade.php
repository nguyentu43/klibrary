@extends("layouts.main")

@section("main")
    <div class="card">
        <div class="card-header">
           @lang('app.user.create')
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('users.store') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">@lang('app.user.name')</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" required class="form-control @error('name') is-invalid  @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">@lang('app.user.email')</label>
                    <div class="col-sm-10">
                        <input type="email" id="email" name="email" required class="form-control @error('email') is-invalid  @enderror" value="{{ old('name') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">@lang('app.user.password')</label>
                    <div class="col-sm-10">
                        <input type="password" id="password" name="password" required class="form-control @error('password') is-invalid  @enderror" value="{{ old('name') }}">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row d-flex align-items-center">
                    <label for="is_admin" class="col-sm-2 col-form-label">@lang('app.user.admin')</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input id="is_admin" class="form-check-input" type="checkbox" name="is_admin">
                            <label for="is_admin" class="form-check-label"></label>
                        </div>
                    </div>
                </div>

                <div class="offset-sm-2 col-sm-10">
                    <button class="btn btn-primary" type="submit">@lang('app.user.create')</button>
                </div>
            </form>
        </div>
    </div>
@endsection