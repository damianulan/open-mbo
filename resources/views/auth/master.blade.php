@php
    $theme = 'light';
    $title = 'Login';
@endphp
@include('layouts.portal.header')
<body>
    <div id="app">
        <div class="content-wrapper h-100">
            @yield('content')
        </div>
@include('layouts.portal.footer')
