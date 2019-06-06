@extends("layouts.main")

@section("main")
    <div class="container-fluid">
        <div class="row">
            @each("components.collection", $collections, "collection", "components.empty")
        </div>
    </div>
@endsection