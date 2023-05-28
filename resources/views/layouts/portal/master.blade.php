@php
    $theme = 'light';
@endphp
@include('layouts.portal.header')
<body>
    <div id="app">
        @include('layouts.portal.sidebar')
        <main id="main-content" class="content <?php if(isset($_COOKIE['menu-collapsed'])&&$_COOKIE['menu-collapsed']==true){ echo 'menu-collapsed'; }?>">
            @include('layouts.portal.topbar')
            <div class="content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>
@include('layouts.portal.footer')
