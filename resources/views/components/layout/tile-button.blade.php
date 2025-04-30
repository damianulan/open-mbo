<a href="{{ $link }}" class="btn-tile">
    @if($icon_html)
        {!! $icon_html !!}
    @endif
    <span>{{ $title }}</span>
    @if($enter_icon)
        <i class="bi bi-arrow-right on-hover"></i>
    @endif
</a>
