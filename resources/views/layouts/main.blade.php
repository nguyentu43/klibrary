@extends("layouts.app")

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 d-none d-sm-none d-md-block">
            @include("components.sidebar")
        </div>

        <div class="col-12 col-md-9">
            @if(session('message'))
                <div class="alert alert-primary mx-3" role="alert">
                    {{ session('message') }}
                </div>
            @endif    
            @yield("main")
        </div>
    </div>
</div>
@endsection