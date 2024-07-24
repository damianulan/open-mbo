@php
    if(!isset($pagetitle)){
        $pagetitle = null;
    }
    $page = new PageBuilder($pagetitle);
@endphp
@include('layouts.portal.header')
<body>
    <div id="app">
        @include('layouts.portal.sidebar')
        <main id="main-content" class="content {{ $page->sidebar_collapsed }}">
            <section class="page-wrapper">
                @include('layouts.portal.topbar')
                <section class="content-wrapper">
                    @yield('content')
                </section>
            </section>
        </main>
@include('layouts.portal.footer')
