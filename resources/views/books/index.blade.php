@extends("layouts.main")

@section("main")
<div class="container">
    <div class="row">
        @each('components.book', $books, 'book')
    </div>
    {{ $books->links() }}
</div>
@endsection