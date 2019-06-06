<div class="col-6 col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $device->name }}</h5>
            <p>@lang('app.device.email'): {{ $device->email }}</p>
            @if($device->default)
                <span class="badge badge-primary">@lang('app.device.this_default')</span>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('devices.edit', compact('device')) }}" class="mr-1 btn btn-success">@lang('app.device.edit')</a>
            <form method="post" class="d-inline" action="{{ route('devices.destroy', compact('device')) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btnDelete" type="submit">@lang('app.device.delete')</button>
            </form>
        </div>
    </div>
</div>