<div id="topbar" class="page-top">
    <div class="togglers">
      <a class="me-2" id="hamburger-toggle"><i class="bi-list"></i></a>
      <a class="me-2" id="menu-toggle" data-bs-toggle="tooltip" data-bs-title="Default tooltip"><i class="bi-three-dots-vertical"></i></a>
    </div>
    <div class="page-heading">
      <span class="page-title">{{ $page->title }}</span>
    </div>
    <div class="page-quick-actions">
        <div class="notification-dropdown">
          <a class="me-3" href="#"><i class="bi bi-bell-fill"></i><span class="badge badge-circle badge-primary">2</span></a>
        </div>
        <div class="user-nav dropup">
            <div class="user-actions" data-bs-toggle="dropdown" role="button" aria-expanded="false">
              <img class="rounded-circle user-avatar-left" src="{{ asset('images/portrait/avatar-male.png'); }}" width="30" height="30">
            </div>
            <ul class="dropdown-menu">
              <li><span class="profile-name">{{ auth()->user()->name() }}</span></li>
              <li><a href="{{ route('profile.index') }}" class="dropdown-item"><i class="bi-person me-2"></i>{{ __('menus.edit_profile') }}</a></li>
              <li><a href="#" class="dropdown-item"><i class="bi-activity me-2"></i>{{ __('menus.activity') }}</a></li>
              <li><a href="#" class="dropdown-item"><i class="bi-list-ol me-2"></i>{{ __('menus.my_results') }}</a></li>
              <li><a href="#" class="dropdown-item"><i class="bi-sliders me-2"></i>{{ __('menus.preferences') }}</a></li>
              <li>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi-door-open me-2"></i>{{ __('menus.logout') }}
                </a>
              </li>
            </ul>
          </div>
          <form action="{{ route('logout') }}" method="POST" class="d-none" id="logout-form">@csrf</form>
    </div>

</div>