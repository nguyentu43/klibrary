@extends('layouts.main')

@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $counts['books'] }} @lang('app.book.plural')</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $counts['collections'] }} @lang('app.collection.plural')</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{ $counts['devices'] }} @lang('app.device.plural')</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 my-2">
            <h2>@lang('app.book.lastest') ({{ count($books) }})</h2>
        </div>
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="row">
                    @each("components.book", $books, 'book', 'components.empty')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
