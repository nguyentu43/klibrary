<div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-1">
    @if($book->trashed())
        @include('components.cover')
        <div class="d-flex mt-2">
            <form method="post" action="{{ route('books.restore', compact('book')) }}">
                @csrf
                @method('PATCH')
                <button class="btn btn-primary mr-1 btn-sm" type="submit">Restore</button>
            </form>
            <form method="post" action="{{ route('books.destroy', compact('book')) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btnDelete btn-sm" type="submit">Delete</button>
            </form>
            
        </div>
    @else
        <a href="{{ route('books.show', ['book' => $book->id]) }}">
            @include('components.cover')
        </a>
    @endif
</div>