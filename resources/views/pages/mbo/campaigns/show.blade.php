@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-left">
        @can('update', $campaign)
            <a class="icon-btn" href="{{ route('campaigns.edit', $campaign->id) }}" data-tippy-content="{{ __('buttons.edit') }}"><i class="bi-pencil-fill"></i></a>
        @endcan
        @can('objectives', $campaign)
            <a href="javascript:void(0);" class="icon-btn add-objective" data-tippy-content="{{ __('mbo.buttons.add_objective') }}"><i class="bi-crosshair"></i></a>
        @endcan
        @can('users', $campaign)
            <a href="javascript:void(0);" class="icon-btn add-users" data-tippy-content="{{ __('buttons.enrol_users') }}"><i class="bi-person-fill-up"></i></a>
        @endcan
        @can('terminate', $campaign)
            @if ($campaign->terminated())
                <a href="javascript:void(0);" class="icon-btn toggle-resume" data-tippy-content="{{ __('buttons.resume_campaign') }}" data-url="{{ route('campaigns.resume', [$campaign->id]) }}"><i class="bi-play-fill"></i></a>
            @else
                <a href="javascript:void(0);" class="icon-btn toggle-terminate" data-tippy-content="{{ __('buttons.terminate_campaign') }}" data-url="{{ route('campaigns.terminate', [$campaign->id]) }}"><i class="bi-pause-fill"></i></a>
            @endif
        @endcan
        @can('cancel', $campaign)
            @if (!$campaign->canceled())
                <a href="javascript:void(0);" class="icon-btn toggle-cancel" data-tippy-content="{{ __('buttons.cancel_campaign') }}" data-url="{{ route('campaigns.cancel', [$campaign->id]) }}"><i class="bi-x-circle"></i></a>
            @endif
        @endcan
    </div>
</div>
<div class="content-card">
    @include('components.mbo.campaign-summary')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 pt-3">
                <h4>{{ __('mbo.objectives.index') }}</h4>
                <x-objectives-list :objectives="$campaign->objectives()->checkAccess()->get()" />
            </div>
            <div class="col-md-5 offset-md-2 pt-3">
                <h4>{{ __('mbo.enroled_users') }}</h4>
                <x-campaign-users-list :userCampaigns="$campaign->user_campaigns" />
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')
<script type="text/javascript">
    var campaign_id = '{{ $campaign->id }}';
    $('.add-objective').on('click', function() {
        $.getModal('campaigns.add_objectives', {campaign_id: campaign_id});
    });
    $('.add-users').on('click', function() {
        $.getModal('campaigns.add_users', {id: campaign_id});
    });
    $('.edit-objective').on('click', function() {
        var model_id = $(this).attr('data-modelid');

        if(model_id && model_id !== ''){
            $.getModal('campaigns.add_objectives', {id: model_id});
        }
    });

    $('.user-delete').on('click', function() {
        var dataurl = $(this).attr('data-url');
        var uc = $(this).parents('li').first();
        $.confirm('Czy na pewno chcesz usunąć tego użytkownika?', null, function() {
            $.jsonAjax(dataurl, {}, function(response) {
                uc.remove();
                $.success(response.message);
            }, function(response){
                $.error(response.message);
            }, 'DELETE' );
        });
    });

    $('.delete-objective').on('click', function() {
        var dataurl = $(this).attr('data-url');
        var uc = $(this).parents('li').first();
        $.confirm('Czy na pewno chcesz usunąć ten cel?', null, function() {
            $.jsonAjax(dataurl, {}, function(response) {
                uc.remove();
                $.success(response.message);
            }, function(response){
                $.error(response.message);
            }, 'DELETE' );
        });
    });

    $('.toggle-resume').on('click', function() {
    var dataurl = $(this).attr('data-url');
    var uc = $(this).parents('li').first();
    $.confirm(
        'Czy na pewno przywrócić tą kampanię? Użytkownicy ponownie zobaczą cele przypisane w ramach tej kampanii, a administratorzy będą mogli ponownie dodawać nowe cele.',
        null,
        function() {
            $.jsonAjax(dataurl, {}, function(response) {
                $.success(response.message, null, function() {
                    location.reload();
                });
            }, function(response) {
                $.error(response.message);
            }, 'POST');
        }
    );
});



$('.toggle-terminate').on('click', function() {
    var dataurl = $(this).attr('data-url');
    var uc = $(this).parents('li').first();
    $.confirm(
        'Czy na pewno zawieścić tą kampanię? Użytkownicy przestaną widzieć cele przypisane w ramach tej kampanii, a administratorzy nie będą mogli dodawać nowych celów.',
        null,
        function() {
            $.jsonAjax(dataurl, {}, function(response) {
                $.success(response.message, null, function() {
                    location.reload();
                });
            }, function(response) {
                $.error(response.message);
            }, 'POST');
        }
    );
});

$('.toggle-cancel').on('click', function() {
    var dataurl = $(this).attr('data-url');
    var uc = $(this).parents('li').first();
    $.confirm(
        'Czy na pewno anulować tą kampanię? Wszelkie operacje przestaną być aktywne oraz znikną z agendy pozostałych użytkowników. Kampania pozostanie widoczna wyłącznie w celach archiwalnych. Operacja jest nieodwracalna!',
        null,
        function() {
            $.jsonAjax(dataurl, {}, function(response) {
                $.success(response.message, null, function() {
                    location.reload();
                });
            }, function(response) {
                $.error(response.message);
            }, 'POST');
        }
    );
});

</script>
@endpush
