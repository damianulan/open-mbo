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
                    $.alert('{!! $a !!}', null, null, '{{ $type }}');
                @endforeach

            @else

                $.alert('{!! session($type_swal) !!}', null, null, '{{ $type }}');

            @endif
        @endif
    @endforeach

</script>
