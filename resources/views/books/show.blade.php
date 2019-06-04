@extends("layouts.main")

@section("main")

<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            @include("components.cover")
            <input type="file">
        </div>
        <div class="col">
            <h2 data-edit-prop="title">{{ $book->title }}</h2>

            <ul class="list-unstyled">
                <li><strong>{{ __('Authors') }}:</strong> <span data-edit-prop="authors">{{ $book->authors }}</span></li>
                <li><strong>{{ __('Publisher') }}:</strong> <span data-edit-prop="publisher">{{ $book->publisher }}</span></li>
                <li><strong>{{ __('Pubished Date') }}:</strong>  <span data-edit-prop="pubdate">{{ $book->pubdate }}</li>
                <li><strong>{{ __('Languages') }}:</strong> <span data-edit-prop="languages">{{ $book->languages }}</span></li>
                <li><strong>{{ __('Identifier') }}:</strong> <span data-edit-prop="identifier">{{ $book->identifier }}</span></li>
                <li><strong>{{ __('Tags') }}:</strong> <span data-edit-prop="tags">{{ $book->tags }}</span></li>
                <li><strong>{{ __('Comments') }}:</strong> <span data-edit-prop="comments">{{ $book->comments }}</span></li>
            </ul>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col">
            <table class="table table-light table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Format</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($book->formats as $format)
                        <tr>
                            <td>{{ $loop->index }}</td>
                            <td>{{ $format }}</td>
                            <td><a role="button" href="{{ route('books.show', [ 'book' => $book->id ]).'?download='.$format }}" class="btn btn-sm btn-primary">Download</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection