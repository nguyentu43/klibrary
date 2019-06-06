@extends("layouts.main")

@section("main")
    <div class="card">
        <div class="card-header">
           @lang('app.user.edit')
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('users.update', compact('user')) }}">
                @csrf
                @method("PATCH")
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">@lang('app.user.name')</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" required class="form-control @error('name') is-invalid  @enderror" value="{{ $user->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">@lang('app.user.email')</label>
                    <div class="col-sm-10">
                        <input type="email" id="email" class="form-control" readonly value="{{ $user->email }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">@lang('app.user.password')</label>
                    <div class="col-sm-10">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid  @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row d-flex align-items-center">
                    <label for="is_admin" class="col-sm-2 col-form-label">@lang('app.user.admin')</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input id="is_admin" class="form-check-input" type="checkbox" name="is_admin" @if($user->isAdmin) checked  @endif>
                            <label for="is_admin" class="form-check-label"></label>
                        </div>
                    </div>
                </div>

                <div class="offset-sm-2 col-sm-10">
                    <button class="btn btn-primary" type="submit">@lang('app.user.update')</button>
                </div>
            </form>
        </div>
    </div>
@endsection