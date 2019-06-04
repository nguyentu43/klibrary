<div class="col-4 col-sm-3 col-md-2 mb-2">
    <a href="{{ route('books.show', ['book' => $book->id]) }}">
        @include('components.cover')
    </a>
</div>