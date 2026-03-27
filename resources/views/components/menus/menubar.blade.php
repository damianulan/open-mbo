@if($menubar->hasItems())
<nav id="{{ $menubar->id }}" class="page-menu {{ implode(' ', $menubar->classes) }}">
    <ul class="nav nav-pills-horizontal">
        @foreach($menubar->getItems() as $menuItem)
            {!! $menuItem->render() !!}
        @endforeach
    </ul>
</nav>
@endif
