<div class="col-12 col-sm-6 mb-1">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <img class="img-fluid" src="{{ asset('img/kindle/'.$device->type.'.jpg') }}" alt="{{$device->type}}">
                </div>
                <div class="col-8">
                    <h5 class="card-title">{{ $device->name }}</h5>
                    <p>@lang('app.device.email'): {{ $device->email }}</p>
                    @if($device->default)
                        <span class="badge badge-primary">@lang('app.device.this_default')</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('devices.edit', compact('device')) }}" class="mr-1 btn btn-success mb-1">@lang('app.device.edit')</a>
            <form method="post" class="d-inline" action="{{ route('devices.destroy', compact('device')) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btnDelete mb-1" type="submit">@lang('app.device.delete')</button>
            </form>
        </div>
    </div>
</div>