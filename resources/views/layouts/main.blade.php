@extends("layouts.app")

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            @include("layouts.sidebar")
        </div>

        <div class="col">
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