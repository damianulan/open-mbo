<nav id="sidebar" class="sidebar-menu menu-fixed pt-0 <?php if(isset($_COOKIE['menu-collapsed'])&&$_COOKIE['menu-collapsed']==true){ echo 'menu-collapsed'; }?>">
    <a class="navbar-brand mb-0 px-6" href="{{ url('/') }}">
        <i class=" fs-2 bi-intersect me-3"></i><span>LMS</span>
    </a>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link{{ request()->routeIs('dashboard') ? ' active':'' }}">
          <i class="bi bi-bullseye"></i>
          <span class="nav-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-multi first">
        <a class="nav-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="recruitment" href="#recruitment">
          <span class="nav-heading"></span><span class="ms-auto" onclick=""><i class="bi-pin-angle"></i></span>
        </a>
        <ul class="collapse show" id="recruitment">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-calendar2-week"></i>
              <span class="nav-title"></span><span class="ms-auto badge badge-circle badge-primary">2</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-chat-left-dots"></i>
              <span class="nav-title"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-person-up"></i>
              <span class="nav-title"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-sun"></i>
              <span class="nav-title"></span>
            </a>
          </li>

        </ul>
      </li>
      <li class="nav-multi">
        <a class="nav-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="administration" href="#administration">
          <span class="nav-heading">Zarządzanie</span><span class="ms-auto" onclick=""><i class="bi-pin-angle"></i></span>
        </a>
        <ul class="collapse show" id="administration">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-graph-up-arrow"></i>
              <span class="nav-title">Raporty</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-box"></i>
              <span class="nav-title">Projekty</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-bell"></i>
              <span class="nav-title">Powiadomienia</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link{{ request()->routeIs('users.*') ? ' active':'' }}" href="{{ route('users.index') }}">
              <i class="bi bi-people"></i>
              <span class="nav-title">Użytkownicy</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-sliders2"></i>
              <span class="nav-title">Ustawienia</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>