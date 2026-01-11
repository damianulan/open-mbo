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
    @foreach ($allowedAlertTypes as $type)
        @php
            $type_swal = $type . '_alert';
        @endphp
        @if (session($type_swal) )
            @if (is_array(session($type_swal)))
                @foreach (session($type_swal) as $a)
                    $.{{ $type }}('{!! $a !!}');
                @endforeach

            @else

                $.{{ $type }}('{!! session($type_swal) !!}');

            @endif
        @endif
    @endforeach

</script>
