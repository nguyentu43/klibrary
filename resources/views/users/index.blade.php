@extends("layouts.main")

@section("main")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table table-light table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>@lang('app.user.name')</th>
                            <th>@lang('app.user.email')</th>
                            <th>@lang('app.user.admin')</th>
                            <th>@lang('app.user.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->isAdmin ? 'x' : 'o' }}</td>
                            <td>
                                <a class="btn btn-success btn-sm" href="{{ route('users.edit', compact('user')) }}" >@lang('app.user.edit')</a>
                                <form method="post" class="d-inline" action="{{ route('users.destroy', compact('user')) }}">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger btn-sm btnDelete" href="{{ route('users.destroy', compact('user')) }}">@lang('app.user.delete')</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection