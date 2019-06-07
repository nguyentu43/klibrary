@extends("layouts.main")

@section("main")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 table-responsive">
                <small>Auto refresh 10s</small>
                <table class="table table-light table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>@lang('app.job.content')</th>
                            <th>@lang('app.job.status')</th>
                            <th>@lang('app.job.started_at')</th>
                            <th>@lang('app.job.finished_at')</th>
                            <th>@lang('app.job.delete')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{ $loop->index }}</td>
                            <td>{{ $job->input[0] }}</td>
                            <td>
                                {{ $job->status }}
                            </td>
                            <td>{{ $job->started_at }}</td>
                            <td>{{ $job->finished_at }}</td>
                            <td>
                                @if(in_array( $job->status, ['failed', 'finished']))
                                <form method="post" action="{{ route('jobs.destroy', compact('job')) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btnDelete" type="submit">@lang('app.job.delete')</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection