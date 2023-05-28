<nav id="sidebar" class="sidebar-menu menu-fixed pt-0 <?php if(isset($_COOKIE['menu-collapsed'])&&$_COOKIE['menu-collapsed']==true){ echo 'menu-collapsed'; }?>">
    <div class="navbar-brand mb-0 px-6">
        <div class="d-flex">
          <a class="brand"  href="{{ url('/') }}">
            <i class="fs-2 bi-tornado"></i><span class="brand-title">{{ config('app.name') }}</span>
          </a>
          <div id="hamburger-close"><i class="bi-x-lg"></i></div>

        </div>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link{{ request()->routeIs('dashboard') ? ' active':'' }}">
          <i class="bi bi-grid-fill"></i>
          <span class="nav-title">{{ __('menus.dashboard') }}</span>
        </a>
      </li>
      <li class="nav-multi first">
        <a class="nav-heading-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="recruitment" href="#recruitment">
          <span class="nav-heading">{{ __('menus.elearning_panel') }}</span><span class="ms-auto" onclick=""><i class="bi-pin-angle-fill pin"></i></span>
        </a>
        <ul class="collapse show" id="recruitment">
          <li class="nav-item">
            <a class="nav-link{{ request()->routeIs('course.*') ? ' active':'' }}" href="#">
              <i class="bi bi-mortarboard-fill"></i>
              <span class="nav-title">{{ __('menus.courses') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-calendar2-week-fill"></i>
              <span class="nav-title">{{ __('menus.calendar') }}</span><span class="ms-auto badge badge-circle badge-primary">2</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-check-square-fill"></i>
              <span class="nav-title">{{ __('menus.tasks') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-signpost-split-fill"></i>
              <span class="nav-title">{{ __('menus.learning_paths') }}</span>
            </a>
          </li>

        </ul>
      </li>
      <li class="nav-multi">
        <a class="nav-heading-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="administration" href="#administration">
          <span class="nav-heading">{{ __('menus.admin_panel') }}</span><span class="ms-auto" onclick=""><i class="bi-pin-angle pin"></i></span>
        </a>
        <ul class="collapse show" id="administration">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-bar-chart-steps"></i>
              <span class="nav-title">{{ __('menus.reports.index') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-box-seam-fill"></i>
              <span class="nav-title">{{ __('menus.projects') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-bell-fill"></i>
              <span class="nav-title">{{ __('menus.notifications') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link{{ request()->routeIs('users.*') ? ' active':'' }}" href="{{ route('users.index') }}">
              <i class="bi bi-people-fill"></i>
              <span class="nav-title">{{ __('menus.users') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link{{ request()->routeIs('management.*') ? ' active':'' }}" href="{{ route('management.index') }}">
              <i class="bi bi-layers-half"></i>
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
      </li>
    </ul>
  </nav>