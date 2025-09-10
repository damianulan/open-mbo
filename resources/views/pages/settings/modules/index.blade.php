@extends('layouts.portal.master')
@section('content')

{!! $nav->render() !!}

<div class="content-card pt-3">
    <div class="content-card-top">
        <div class="content-card-header">
            {{ __('Zarządzanie ustawieniami modułów') }}
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-5 col-md-6 col-sm-12">
            @if(!empty($modules))
                @foreach ($modules as $module)
                    <div class="my-3">
                        <x-tile-button id="{{ $module['id'] }}" title="{{ $module['title'] }}" link="{{ $module['route'] }}" icon="{{ $module['icon'] }}" classes="module-tile"/>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-xl-9 col-lg-7 col-md-6 col-sm-12">
            <div class="container pt-3" id="module-users" style="display: none;">
                Ustawienia Użytkownicy
            </div>
            <div class="container pt-3" id="module-mbo" style="display: none;">
                {{ $mboForm->render() }}
            </div>
        </div>

    </div>

</div>

@endsection
@push('scripts')
<script type="text/javascript">
    var default_mod = '{{ $mod }}';

    $(document).ready(function() {
        if(default_mod !== ''){
            $('#'+default_mod).trigger('click');
        }
    });

    $('.module-tile').on('click', function() {
        var module_id = $(this).attr('id');
        $('.module-tile').each(function() {
            $(this).removeClass('selected');
        });

        if(module_id && module_id !== ''){
            if(module_id === 'module-users-btn'){
                $('#module-users').fadeIn(500);
                $(this).addClass('selected');
            } else {
                $('#module-users').hide();
            }
            if(module_id === 'module-mbo-btn'){
                $('#module-mbo').fadeIn(500);
                $(this).addClass('selected');
            } else {
                $('#module-mbo').hide();
            }
        }
    });
</script>

@endpush
