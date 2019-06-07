<nav class="nav nav-pills flex-column" id="sidebar">
    <li class="nav-item">
        <a class="nav-link @route('home') active @endroute" href="{{ route('home') }}">{{ __('Home') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @route('books') active @endroute d-flex align-items-center justify-content-between" href="{{ route('books.index') }}">
            @lang('app.book.plural')
            <button class="btn btn-light btn-sm" data-href="{{ route('books.create') }}">+</button>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @route('collections') active @endroute d-flex align-items-center justify-content-between" href="{{ route('collections.index') }}">
            @lang('app.collection.plural')
            <button class="btn btn-light btn-sm" data-href="{{ route('collections.create') }}">+</button>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @route('devices') active @endroute d-flex align-items-center justify-content-between" href="{{ route('devices.index') }}">
            @lang('app.device.plural')
            <button class="btn btn-light btn-sm" data-href="{{ route('devices.create') }}">+</button>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @route('jobs') active @endroute d-flex align-items-center justify-content-between" href="{{ route('jobs.index') }}">
            @lang('app.job.plural')
        </a>
    </li>
@admin
    <li class="nav-item">
        <a class="nav-link @route('users') active @endroute d-flex align-items-center justify-content-between" href="{{ route('users.index') }}">
            @lang('app.user.plural')
            <button class="btn btn-light btn-sm" data-href="{{ route('users.create') }}">+</button>
        </a>
    </li>
@endadmin
</nav>