@extends("layouts.main")

@section("main")

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-3 mb-1">
            @include("components.cover")
        </div>
        <div class="col">
            <h2 data-edit-prop="title">{{ $book->title }}</h2>
            @php
                $collections = $book->collections()->get();
            @endphp
            <h5>
                Collections:
                @if(count($collections) === 0)
                    @lang('app.book.empty')
                @else
                    @foreach($collections as $collection)
                        <a href="{{ route('collections.show', compact('collection')) }}">{{ $collection->name }}{{ $loop->last ? '' : ', ' }}</a>
                    @endforeach
                @endif
            </h5>
            <ul class="list-unstyled">
                <li><strong>@lang('app.book.authors'):</strong> {{ $book->authors ?? __('app.book.empty') }}</li>
                <li><strong>@lang('app.book.publisher'):</strong> {{ $book->publisher ?? __('app.book.empty') }}</li>
                <li><strong>@lang('app.book.pubdate'):</strong> {{ $book->date ?? __('app.book.empty') }}</li>
                <li><strong>@lang('app.book.language'):</strong> {{ $book->language ?? __('app.book.empty') }}</li>
                <li><strong>@lang('app.book.identifier'):</strong> {{ $book->identifier ?? __('app.book.empty')  }}</li>
                <li><strong>@lang('app.book.tags'):</strong> {{ $book->tags ?? __('app.book.empty') }}</li>
                <li><strong>@lang('app.book.comments'):</strong> {{ $book->comments ?? __('app.book.empty') }}</li>
            </ul>
            <form method="post" action="{{ route('books.destroy', compact('book')) }}">
                @csrf
                @method("DELETE")
                <a class="btn btn-success mb-1" href="{{ route('books.edit', ['book' => $book]) }}">@lang('app.book.edit')</a>
                <div class="btn-group mb-1">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('app.book.convert')
                    </button>
                    <div class="dropdown-menu">
                        @foreach($supportTypes as $format)
                            @if(!in_array($format, $book->formats))
                                <a class="dropdown-item" href="{{ route('books.convert', ['book' => $book ]).'?format='.$format }}">{{ strtoupper($format) }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <button class="btn mb-1 btn-danger btnDelete" type="submit">@lang('app.book.delete')</button>
            </form>

            @if(session('formatConvertError'))
                <div class="alert alert-warning mt-2" role="alert">
                    {{ session('formatConvertError') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row mt-2">
        <div class="col table-responsive">
            <table class="table table-light table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>@lang('app.book.format')</th>
                        <th>@lang('app.book.size')</th>
                        <th>@lang('app.book.send')</th>
                        <th>@lang('app.book.download')</th>
                        <th>@lang('app.book.delete_format')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($book->formats as $format)
                        <tr>
                            <td>{{ $loop->index }}</td>
                            <td>{{ $format }} </td>
                            <td>
                                @php
                                    $size = Storage::size('ebooks/'.$book->id.".$format") / 1024 / 1024;
                                @endphp
                                {{ round($size, 2) }} MB
                            </td>
                            <td>
                                @if($size < 19 * 1024 * 1024 && in_array($format, ['docx', 'mobi', 'pdf']))
                                <button class="btn btn-sm btn-success btnSend" data-format="{{ $format }}" type="button" data-toggle="modal" data-target="#send">@lang('app.book.send')</button>
                                @endif
                            </td>
                            <td><a role="button" href="{{ route('books.show', [ 'book' => $book->id ]).'?download='.$format }}" class="btn btn-sm btn-primary">@lang('app.book.download')</a></td>
                            <td>
                                @if($loop->count > 1)
                                    <button data-href="{{ route('books.show', [ 'book' => $book->id ]).'?delete='.$format }}" class="btn btn-sm btn-warning deleteFormat">@lang('app.book.delete')</button></td>
                                @endif
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="send" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="send-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="send-title">@lang('app.book.send')</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('books.send', compact('book')) }}">
                        @csrf
                        <input type="hidden" name="format" value="">
                        <div class="form-group row">
                            <label for="email_from" class="col-sm-3 col-form-label">@lang('app.user.email_from')</label>
                            <div class="col-sm-9">
                                <select id="email_from" class="form-control" name="email_from" required>
                                    @php
                                        $list = Auth::user()->email_approved_list ?? [];
                                    @endphp
                                    @foreach($list as $email)
                                        <option
                                        value="{{ $email }}">
                                            {{ $email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_to" class="col-sm-3 col-form-label">@lang('app.user.email_to')</label>
                            <div class="col-sm-9">
                                <select id="email_to" class="form-control" name="email_to" required>
                                    @php
                                        $list = Auth::user()->devices()->pluck('email')->all();
                                    @endphp
                                    @foreach($list as $email)
                                        <option
                                        value="{{ $email }}">
                                            {{ $email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">@lang('app.book.send')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection