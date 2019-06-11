@if($book->cover)
    <img class="img-fluid" src="{{ asset('storage/covers/'.$book->id.'.jpg') }}" alt="{{ $book->title }}">
@else
    <img class="img-fluid" src="{{ asset('storage/covers/no_cover.jpg')}}" alt="{{ $book->title  }}" >
    @route('books.index')
    <div class="text-center" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap">{{ $book->title }}</div>
    @endroute
@endif
