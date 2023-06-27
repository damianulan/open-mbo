@php
    if(!isset($pagetitle)){
        $pagetitle = null;
    }
    $page = new PageHeader($pagetitle);
@endphp
@include('layouts.portal.header')
<body>
    <div id="app">
        <div class="content-wrapper h-100">
            @yield('content')
        </div>
@include('layouts.portal.footer')
