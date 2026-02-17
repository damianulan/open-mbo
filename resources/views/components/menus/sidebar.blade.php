<nav id="{{ $sidebar->id }}" class="sidebar-menu menu-fixed pt-0 {{ implode(' ', $sidebar->classes) }}">
    <div class="navbar-brand mb-0 px-6">
        <div class="d-flex">
          @branding
          <div id="hamburger-close"><i class="bi-x-lg"></i></div>
        </div>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
        @foreach($sidebar->items as $sidebarItem)
            {!! $sidebarItem->render() !!}
        @endforeach
    </ul>
    <div class="sidebar-footer">
        @if(config('app.debug'))
            <div class="menu-release">
                <a href="{{ url('https://damianulan.me') }}">damianulan © {{ date('Y') }}</a>
            </div>
            <div class="menu-release">
                v. {{ config('app.release') }}
            </div>
        @endif
    </div>
  </nav>
