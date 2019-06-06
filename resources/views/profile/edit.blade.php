@extends("layouts.main")

@section("main")
    <div class="card">
        <div class="card-header">
           @lang('app.user.profile')
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('profile.update') }}">
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
                    <label for="old_password" class="col-sm-2 col-form-label">@lang('app.user.old_password')</label>
                    <div class="col-sm-10">
                        <input type="password" id="old_password" name="old_password" class="form-control @error('old_password') is-invalid  @enderror">
                        @error('old_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">@lang('app.user.new_password')</label>
                    <div class="col-sm-10">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid  @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">@lang('app.user.confirm_password')</label>
                    <div class="col-sm-10">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email_approved_list" class="col-sm-2 col-form-label">@lang('app.user.email_approved_list')</label>
                    <div class="col-sm-10">
                        <textarea id="email_approved_list" name="email_approved_list" class="form-control @error('email_approved_list') is-invalid @enderror">{!! implode('&#13;&#10;', $user->email_approved_list ?? []) !!}</textarea>
                        @error('email_approved_list')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small><a href="https://www.amazon.com/gp/help/customer/display.html?ie=UTF8&nodeId=201974240" target="_blank">(*) @lang('app.user.link_approved_kindle')</a></small>
                    </div>
                </div>

                <div class="offset-sm-2 col-sm-10">
                    <button class="btn btn-primary" type="submit">@lang('app.user.update')</button>
                </div>
            </form>
        </div>
    </div>
@endsection