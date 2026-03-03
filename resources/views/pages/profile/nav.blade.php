<div class="container-fluid">
    <div class="page-menu">
        <ul class="nav nav-pills-horizontal">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}" href="{{ route('profile.index') }}">
                    {{ __('menus.profile.edit') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.preferences') ? 'active' : '' }}" href="{{ route('profile.preferences') }}">
                    {{ __('menus.preferences') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.logs') ? 'active' : '' }}" href="{{ route('profile.logs') }}">
                    {{ __('menus.profile.logs') }}
                </a>
            </li>
        </ul>
    </div>
</div>
