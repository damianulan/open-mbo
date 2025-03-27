<nav id="{{ $sidebar->id }}" class="sidebar-menu menu-fixed pt-0 {{ implode(' ', $sidebar->classes) }}">
    <div class="navbar-brand mb-0 px-6">
        <div class="d-flex">
          <a class="brand" href="{{ url('/') }}">
            </i><span class="brand-title">{{ $sidebar->sitename }}</span>
          </a>
          <div id="hamburger-close"><i class="bi-x-lg"></i></div>

        </div>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
        @foreach($sidebar->items as $sidebarItem)
            {!! $sidebarItem->render() !!}
        @endforeach
    </ul>
  </nav>
