@php
    $page = app('page');
@endphp
@include('layouts.portal.header')
<body>
    <div id="app">

        {!! $page->getNavigation()?->renderSidebar() !!}
        <main id="main-content" class="{{ $page->getMainContentClasses() }}">
            <section class="page-wrapper">
                {!! $page->getNavigation()?->renderTopbar() !!}
                <section class="content-wrapper">
                    {!! $page->getNavigation()?->renderPageNav() !!}
                    @yield('content')
                </section>
            </section>
        </main>
@include('layouts.portal.footer')
