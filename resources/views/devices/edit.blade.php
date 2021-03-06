@extends('layouts.main')

@section('main')
<div class="card">
        <div class="card-header">
            @lang('app.device.edit')
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('devices.update', compact('device')) }}">
                @csrf
                @method("PATCH")
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">@lang('app.device.name')</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" required class="form-control @error('name') is-invalid  @enderror" value="{{ $device->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="type" class="col-sm-2 col-form-label">@lang('app.device.type')</label>
                    <div class="col-sm-10">
                        <select id="typesDropdown" name="type" required class="form-control @error('type') is-invalid  @enderror">
                            @foreach($supportDevices as $key => $value)
                                <option @if($key === $device->type) selected @endif data-img-src="{{ asset('img/kindle/'.$key.'.jpg') }}" value="{{ $key }}"> {{ $value }} </option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">@lang('app.device.email')</label>
                    <div class="col-sm-10">
                        <input type="text" id="email" name="email" required class="form-control @error('email') is-invalid  @enderror" value="{{ $device->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row d-flex align-items-center">
                    <label for="name" class="col-sm-2 col-form-label">@lang('app.device.default')</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input id="default" class="form-check-input" type="checkbox" name="default" @if($device->default) checked  @endif>
                            <label for="default" class="form-check-label"></label>
                        </div>
                    </div>
                </div>

                <div class="offset-sm-2 col-sm-10">
                    <button class="btn btn-primary" type="submit">@lang('app.device.update')</button>
                </div>
            </form>
        </div>
    </div>
@endsection