@extends("layouts.app")

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            @include("layouts.sidebar")
        </div>

        <div class="col">
            @yield("main")
        </div>
    </div>
</div>
@endsection