<nav id="topbar" class="page-top">
    <div class="ms-2">
        {{ Breadcrumbs::render(Route::currentRouteName()) }}
    </div>
    <div class="page-top-elements">
        <div class="togglers">
            <a class="me-2" id="hamburger-toggle"><i class="bi-list"></i></a>
            <a class="me-2" id="menu-toggle"><i class="bi-three-dots-vertical"></i></a>
          </div>
          <header class="page-heading">
            <span class="page-title" data-tippy-placement="bottom" data-tippy-content="{{ $page->title }}">{{ $page->title }}</span>
            @if($page->info)
                <i class="bi bi-question-circle" data-tippy-placement="bottom" data-tippy-content="{{ $page->info }}"></i>
            @endif
          </header>
          <div class="page-quick-actions">
            @if(config('app.maintenance') === true)
                <div class="me-3">
                    <a href="javascript:void(0);" data-tippy-placement="bottom" data-tippy-content="{{ __('alerts.info.maintenance') }}">
                        <i class="bi text-danger bi-exclamation-triangle-fill"></i>
                    </a>
                </div>
            @endif
            @if(config('app.env') === 'local')
                <div class="me-3">
                    <a href="javascript:void(0);" data-tippy-placement="bottom" data-tippy-content="{{ __('alerts.info.env_local') }}">
                        <i class="bi bi-code-square"></i>
                    </a>
                </div>
            @endif
            @if(config('app.env') === 'development')
                <div class="me-3">
                    <a href="javascript:void(0);" data-tippy-placement="bottom" data-tippy-content="{{ __('alerts.info.env_development') }}">
                        <i class="bi bi-code-slash"></i>
                    </a>
                </div>
            @endif
            @if(config('app.debug') === true)
                <div class="me-3">
                    <a href="javascript:void(0);" data-tippy-placement="bottom" data-tippy-content="{{ __('alerts.info.debugging') }}">
                        <i class="bi bi-bug-fill"></i>
                    </a>
                </div>
            @endif
              <div class="me-3">
                <a href="#" data-tippy-placement="bottom" data-tippy-content="Baza wiedzy">
                    <i class="bi bi-book-fill"></i>
                </a>
              </div>
              <x-notification-dropdown/>
              <div class="user-nav dropup"
              @if(auth()->user()->isImpersonating())
              data-tippy-placement="left"
              data-tippy-content="{{ __('menus.impersonated_by', ['name' => auth()->user()->impersonator()->name()]) }}"
              @endif
              >
                  <div class="user-actions" data-bs-toggle="dropdown" type="button" aria-expanded="false">
                    <img class="rounded-circle" src="{{ auth()->user()->getAvatar() }}" width="30" height="30">
                    <span class="profile-name{{auth()->user()->isImpersonating() ? ' text-info':''}}">{{ auth()->user()->name() }}</span>
                  </div>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('profile.index') }}" class="dropdown-item"><i class="bi-person me-2"></i>{{ __('menus.edit_profile') }}</a></li>
                    <li><a href="{{ route('profile.logs') }}" class="dropdown-item"><i class="bi-activity me-2"></i>{{ __('menus.activity') }}</a></li>
                    <li>
                      <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="bi-person-walking me-2"></i>{{ __('menus.logout') }}
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

    </div>

</nav>
