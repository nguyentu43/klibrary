@extends("layouts.main")

@section("main")
<div class="container">
    <div class="row">
        <div class="col mb-2 text-right">
            @if(empty($show))
                <a class="btn btn-primary btn-sm" href="{{ route('books.index').'?show=trashed' }}">@lang('app.book.show_trash')</a>
            @else
                <a class="btn btn-primary btn-sm" href="{{ route('books.index') }}">@lang('app.book.hide_trash')</a>
            @endif
        </div>
    </div>
    <div class="row">
        @each('components.book', $books, 'book', 'components.empty')
    </div>
    <div class="row">
        <div class="col">
            @if(empty($show))
                {{ $books->links() }}
            @else
                {{ $books->appends(['show' => $show])->links() }}
            @endif
        </div>
    </div>
</div>
@endsection