@php
    $theme = 'light';
@endphp
@include('layouts.portal.header')
<body>
    <div id="app">
        @include('layouts.portal.sidebar')
        <main id="main-portal" class="content <?php if(isset($_COOKIE['menu-collapsed'])&&$_COOKIE['menu-collapsed']==true){ echo 'menu-collapsed'; }?>">
            <div class="page-top">
                <div class="page-title">
                    {{ $title }}
                </div>
                <div class="page-quick-actions">
                    <a class="me-3" href="#"><i class="bi bi-bell-fill"></i><span class="badge badge-circle badge-primary">2</span></a>
                    <a class="me-3" href="#"><i class="bi bi-gear-fill"></i></a>
                    <div class="user-nav dropup">
                        <div class="user-actions" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                          <img class="rounded-circle user-avatar-left" src="{{ asset('images/portrait/avatar-male.png'); }}" width="30" height="30">
                        </div>
                        <ul class="dropdown-menu">
                          <li><a href="#" class="dropdown-item">Edytuj profil</a></li>
                          <li><a href="#" class="dropdown-item">Preferencje</a></li>
                          <li>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Wyloguj
                            </a>
                          </li>
                        </ul>
                      </div>
                      <form action="{{ route('logout') }}" method="POST" class="d-none" id="logout-form">@csrf</form>
                </div>

            </div>
            <div class="content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>
@include('layouts.portal.footer')
