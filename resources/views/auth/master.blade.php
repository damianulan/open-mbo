@php
    if(!isset($pagetitle)){
        $pagetitle = null;
    }
    $page = new PageBuilder($pagetitle, false, false);
    //dd($page);
@endphp
@include('layouts.portal.header')
<body>
    <div id="app">
        <main id="main-content">
            <section class="page-wrapper">
                @include('layouts.portal.topbar')
                <section class="content-wrapper">
                    @yield('content')
                </section>
            </section>
        </main>
@include('layouts.portal.footer')
