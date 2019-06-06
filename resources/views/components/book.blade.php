<div class="col-4 col-sm-3 col-md-2 mb-2">
    @if($book->trashed())
        @include('components.cover')
        <div class="d-flex mt-2">
            <form method="post" action="{{ route('books.restore', compact('book')) }}">
                @csrf
                @method('PATCH')
                <button class="btn btn-primary mr-1" type="submit">Restore</button>
            </form>
            <form method="post" action="{{ route('books.destroy', compact('book')) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btnDelete" type="submit">Delete</button>
            </form>
            
        </div>
    @else
        <a href="{{ route('books.show', ['book' => $book->id]) }}">
            @include('components.cover')
        </a>
    @endif
</div>