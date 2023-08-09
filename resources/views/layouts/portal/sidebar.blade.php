<nav id="sidebar" class="sidebar-menu menu-fixed pt-0 {{ $page->menu_collapsed }}">
    <div class="navbar-brand mb-0 px-6">
        <div class="d-flex">
          <a class="brand"  href="{{ url('/') }}">
            </i><span class="brand-title">{{ $page->sitename }}</span>
          </a>
          <div id="hamburger-close"><i class="bi-x-lg"></i></div>

        </div>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item" id="nav_dashboard">
        <a href="{{ route('dashboard') }}" class="nav-link{{ request()->routeIs('dashboard') ? ' active':'' }}">
          <i class="bi bi-grid-fill"></i>
          <span class="nav-title">{{ __('menus.dashboard') }}</span>
        </a>
      </li>
      <li class="nav-item" id="nav_objectives">
        <a class="nav-link" href="#">
          <i class="bi bi-clipboard-check-fill"></i>
          <span class="nav-title">Moje cele</span>
        </a>
      </li>
      <li class="nav-item" id="nav_forms">
        <a class="nav-link" href="#">
          <i class="bi bi-ui-radios"></i>
          <span class="nav-title">Moje formularze</span>
        </a>
      </li>
      <li class="nav-item" id="nav_campaign">
        <a href="{{ route('campaigns.index') }}" class="nav-link{{ request()->routeIs('campaigns.*') ? ' active':'' }}">
          <i class="bi bi-bullseye"></i>
          <span class="nav-title">{{ __('menus.campaigns.index') }}</span>
        </a>
      </li>
      <li class="nav-item" id="nav_reports">
        <a class="nav-link" href="#">
          <i class="bi bi-bar-chart-steps"></i>
          <span class="nav-title">{{ __('menus.reports.index') }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link{{ request()->routeIs('users.*') ? ' active':'' }}" href="{{ route('users.index') }}">
          <i class="bi bi-people-fill"></i>
          <span class="nav-title">{{ __('menus.users.index') }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link{{ request()->routeIs('management.*') ? ' active':'' }}" href="{{ route('management.index') }}">
          <i class="bi bi-diagram-3-fill"></i>
          <span class="nav-title">{{ __('menus.management.index') }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link{{ request()->routeIs('settings.*') ? ' active':'' }}" href="{{ route('settings.index') }}">
          <i class="bi bi-ui-radios-grid"></i>
          <span class="nav-title">{{ __('menus.settings.index') }}</span>
        </a>
      </li>
    </ul>
  </nav>
