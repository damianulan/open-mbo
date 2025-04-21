<nav id="{{ $sidebar->id }}" class="sidebar-menu menu-fixed pt-0 {{ implode(' ', $sidebar->classes) }}">
    <div class="navbar-brand mb-0 px-6">
        <div class="d-flex">
          <a class="brand" href="{{ url('/') }}">
            <div class="brand-icon"><i class="bi-layers-half"></i></div>
            <div class="brand-title">Open<span class="brand-title-2">MBO</span></div>
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
