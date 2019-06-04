@if($book->cover)
    <img class="img-fluid" src="{{ asset('storage/covers/'.$book->id.'.jpg') }}" alt="{{ $book->title }}">
@else
    {{ $book->title }}
@endif