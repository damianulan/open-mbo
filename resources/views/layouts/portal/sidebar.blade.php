<nav id="sidebar" class="sidebar-menu menu-fixed pt-0 <?php if(isset($_COOKIE['menu-collapsed'])&&$_COOKIE['menu-collapsed']==true){ echo 'menu-collapsed'; }?>">
    <a class="navbar-brand mb-0 px-6" href="{{ url('/') }}">
        <i class="fs-3 bi-easel2-fill me-3"></i><span>LMS</span>
    </a>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link{{ request()->routeIs('dashboard') ? ' active':'' }}">
          <i class="bi bi-grid-fill"></i>
          <span class="nav-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-multi first">
        <a class="nav-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="recruitment" href="#recruitment">
          <span class="nav-heading">Panel szkoleniowy</span><span class="ms-auto" onclick=""><i class="bi-pin-angle-fill pin"></i></span>
        </a>
        <ul class="collapse show" id="recruitment">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-mortarboard-fill"></i>
              <span class="nav-title">Kursy</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-calendar2-week-fill"></i>
              <span class="nav-title">Kalendarz</span><span class="ms-auto badge badge-circle badge-primary">2</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-check-square-fill"></i>
              <span class="nav-title">Zadania</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-signpost-split-fill"></i>
              <span class="nav-title">Ścieżki edukacyjne</span>
            </a>
          </li>

        </ul>
      </li>
      <li class="nav-multi">
        <a class="nav-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="administration" href="#administration">
          <span class="nav-heading">Zarządzanie</span><span class="ms-auto" onclick=""><i class="bi-pin-angle pin"></i></span>
        </a>
        <ul class="collapse show" id="administration">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-bar-chart-steps"></i>
              <span class="nav-title">Raporty</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-box-seam-fill"></i>
              <span class="nav-title">Projekty</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-bell-fill"></i>
              <span class="nav-title">Powiadomienia</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link{{ request()->routeIs('users.*') ? ' active':'' }}" href="{{ route('users.index') }}">
              <i class="bi bi-people-fill"></i>
              <span class="nav-title">Użytkownicy</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link{{ request()->routeIs('management.*') ? ' active':'' }}" href="{{ route('management.index') }}">
              <i class="bi bi-layers-half"></i>
              <span class="nav-title">Zarządzanie</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link{{ request()->routeIs('settings.*') ? ' active':'' }}" href="{{ route('settings.index') }}">
              <i class="bi bi-ui-radios-grid"></i>
              <span class="nav-title">Ustawienia</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>