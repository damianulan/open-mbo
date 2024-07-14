@php
    $allowedAlertTypes = [
        'success',
        'error',
        'warning',
        'info',
    ]
@endphp
<script type="text/javascript">
    @foreach ($allowedAlertTypes as $type)
        @if (session($type) )
            @if (is_array(session($type)))
                @foreach (session($type) as $a)
                    $.notify('{!! $a !!}','{{ $type }}');
                @endforeach

            @else

            $.notify('{!! session($type) !!}', '{{ $type }}');

            @endif
        @endif
    @endforeach

</script>
