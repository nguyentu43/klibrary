@extends("layouts.main")

@section("main")
    <div class="container-fluid">
        <div class="row">
            @each("components.device", $devices, "device", "components.empty")
        </div>
    </div>
@endsection