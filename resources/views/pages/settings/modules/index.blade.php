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
        @if(!empty($modules))
            @foreach ($modules as $module)
                <div class="col-xl-3 col-md-4 col-sm-6 col-xs-12 pt-3">
                    <x-tile-button id="{{ $module['id'] }}" title="{{ $module['title'] }}" link="{{ $module['route'] }}" icon="{{ $module['icon'] }}" classes="module-tile"/>
                </div>
            @endforeach

        @endif
    </div>
    <div class="container pt-4" id="module-users" style="display: none;">
        Ustawienia Użytkownicy
    </div>
    <div class="container pt-4" id="module-mbo" style="display: none;">
        Ustawienia MBO
    </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
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
