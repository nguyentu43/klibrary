<nav class="nav nav-pills flex-column" id="sidebar">
    <li class="nav-item">
        <a class="nav-link @route('home') active @endroute" href="{{ route('home') }}">{{ __('Home') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @route('books') active @endroute d-flex align-items-center justify-content-between" href="{{ route('books.index') }}">
            <div>{{ __('Books') }}</div>
            <button class="btn btn-light btn-sm" data-href="{{ route('books.create') }}">+</button>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @route('collections') active @endroute d-flex align-items-center justify-content-between" href="{{ route('collections.index') }}">
            {{ __('Collections') }}
            <button class="btn btn-light btn-sm" data-href="{{ route('collections.create') }}">+</button>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @route('devices') active @endroute d-flex align-items-center justify-content-between" href="{{ route('devices.index') }}">
            {{ __('Devices') }}
            <button class="btn btn-light btn-sm" data-href="{{ route('devices.create') }}">+</button>
        </a>
    </li>
@admin
    <li class="nav-item">
        <a class="nav-link @route('users') active @endroute d-flex align-items-center justify-content-between" href="{{ route('users.index') }}">
            {{ __('Users') }}
            <button class="btn btn-light btn-sm" data-href="{{ route('users.create') }}">+</button>
        </a>
    </li>
@endadmin
</nav>

<script src="{{ asset('js/sidebar.js') }}" defer>
</script>