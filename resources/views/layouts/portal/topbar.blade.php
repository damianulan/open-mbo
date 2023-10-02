<nav id="topbar" class="page-top">
    <div class="togglers">
      <a class="me-2" id="hamburger-toggle"><i class="bi-list"></i></a>
      <a class="me-2" id="menu-toggle"><i class="bi-three-dots-vertical"></i></a>
    </div>
    <div class="page-heading">
      <span class="page-title" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ $page->title }}">{{ $page->title }}</span>
    </div>
    <div class="page-quick-actions">
        <!--<x-notification-dropdown/>-->
        <div class="user-nav dropup"
        @if(auth()->user()->isImpersonating())
        data-bs-toggle="tooltip" data-bs-placement="left"
        data-bs-title="{{ __('menus.impersonated_by', ['name' => auth()->user()->impersonator()->name()]) }}"
        @endif
        >
            <div class="user-actions" data-bs-toggle="dropdown" type="button" aria-expanded="false">
              <img class="rounded-circle" src="{{ auth()->user()->getAvatar() }}" width="30" height="30">
              <span class="profile-name{{auth()->user()->isImpersonating() ? ' text-info':''}}">{{ auth()->user()->name() }}</span>
            </div>
            <ul class="dropdown-menu">
              <li><a href="{{ route('profile.index') }}" class="dropdown-item"><i class="bi-person me-2"></i>{{ __('menus.edit_profile') }}</a></li>
              <li><a href="#" class="dropdown-item"><i class="bi-activity me-2"></i>{{ __('menus.activity') }}</a></li>
              <li><a href="#" class="dropdown-item"><i class="bi-list-ol me-2"></i>{{ __('menus.my_results') }}</a></li>
              <li><a href="#" class="dropdown-item"><i class="bi-sliders me-2"></i>{{ __('menus.preferences') }}</a></li>
              <li>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi-door-open me-2"></i>{{ __('menus.logout') }}
                </a>
              </li>
              @if(auth()->user()->isImpersonating())
              <li>
                <a href="{{ route('users.impersonate.leave') }}" class="dropdown-item"><i class="bi-person-fill-down me-2"></i>{{ __('menus.impersonation_leave') }}</a>
              </li>
              @endif
            </ul>
          </div>
          <form action="{{ route('logout') }}" method="POST" class="d-none" id="logout-form">@csrf</form>
    </div>

</nav>
