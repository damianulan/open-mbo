<div class="container-fluid">
  <div class="page-menu">
      <ul class="nav nav-pills-horizontal">
          <li class="nav-item">
              <a class="nav-link{{ request()->routeIs('settings.index') ? ' active':'' }}" href="{{ route('settings.index') }}">
                {{ __('menus.settings.general') }}
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link">
                {{ __('menus.settings.integrations') }}
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link{{ request()->routeIs('settings.server') ? ' active':'' }}" href="{{ route('settings.server') }}">
                {{ __('menus.settings.server') }}
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link">
                {{ __('menus.settings.logs') }}
            </a>
        </li>
          <li class="nav-item">
              <a class="nav-link">
                {{ __('menus.settings.help') }}
              </a>
          </li>
      </ul>
  </div>
</div>
