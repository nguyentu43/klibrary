<div class="col-12 col-sm-6 col-md-4 mb-1">
    <a class="text-decoration-none text-dark" href="{{ route('collections.show', compact('collection')) }}">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">{{ $collection->name }}</h3>
                <p class="card-text">{{ $collection->books()->count() }} @lang('app.book.plural')</p>
            </div>
        </div>
    </a>
</div>