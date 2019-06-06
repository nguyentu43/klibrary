@extends("layouts.main")

@section("main")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table table-light table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>@lang('app.job.content')</th>
                            <th>@lang('app.job.status')</th>
                            <th>@lang('app.job.started_at')</th>
                            <th>@lang('app.job.finished_at')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{ $loop->index }}</td>
                            <td>{{ $job->input[0] }}</td>
                            <td>{{ $job->status }}</td>
                            <td>{{ $job->started_at }}</td>
                            <td>{{ $job->finished_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection