@extends('layouts.main')

@section('main')
<div class="container">
    <div class="row">
        <div class="col-6 col-md-4 mb-1">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $counts['books'] }} @lang('app.book.plural')</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 mb-1">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $counts['collections'] }} @lang('app.collection.plural')</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 mb-1">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $counts['devices'] }} @lang('app.device.plural')</p>
                </div>
            </div>
        </div>

        @if(isset($books) || isset($collection))
        <div class="col-md-12 my-2">
            <h2>@lang('app.home.search')</h2>
        </div>

        @isset($books)
        <div class="col-md-12 my-2">
            <h3>@lang('app.book.plural')</h3>
        </div>
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="row">
                    @each("components.book", $books, 'book', 'components.empty-search')
                </div>
            </div>
        </div>
        @endisset

        @isset($books)
        <div class="col-md-12 my-2">
            <h3>@lang('app.collection.plural')</h3>
        </div>
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="row">
                    @each("components.collection", $collections, 'collection', 'components.empty-search')
                </div>
            </div>
        </div>
        @endisset

        @endif

        <div class="col-md-12 my-2">
            <h2>@lang('app.book.lastest') ({{ count($lastestBooks) }})</h2>
        </div>
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="row">
                    @each("components.book", $lastestBooks, 'book', 'components.empty')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
