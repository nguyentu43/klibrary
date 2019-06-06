<div class="col-6 col-sm-4 col-md-3">
    <a class="text-decoration-none text-dark" href="{{ route('collections.show', compact('collection')) }}">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $collection->name }}</h2>
                <p class="card-text">{{ $collection->books()->count() }} @lang('app.book.plural')</p>
            </div>
        </div>
    </a>
</div>