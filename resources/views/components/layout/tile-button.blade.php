@php
    if($selected){
        $classes .= ' selected';
    }
@endphp
<a @if ($id) id="{{ $id }}" @endif href="{{ $link }}" class="btn-tile {{ $classes }}">
    @if($icon_html)
        {!! $icon_html !!}
    @endif
    <span>{{ $title }}</span>
    @if($enter_icon)
        <i class="bi enter--icon bi-arrow-right on-hover"></i>
    @endif
</a>
