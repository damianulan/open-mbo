@if($item->isVisible())
<li class="nav-item{{ $item->disabled() ? ' disabled':'' }}" id="nav_{{ $item->id() }}">
    <a href="{{ $item->link() }}" class="nav-link{{ $item->active() ? ' active':'' }}">
        {!! $item->icon() !!}
        <span class="nav-title">{{ $item->title() }}</span>
    </a>
</li>
@endif
