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
                <a href="javascript:void(0);" class="icon-btn toggle-terminate" data-tippy-content="{{ __('buttons.resume_campaign') }}"><i class="bi-play-fill"></i></a>
            @else
                <a href="javascript:void(0);" class="icon-btn toggle-terminate" data-tippy-content="{{ __('buttons.terminate_campaign') }}"><i class="bi-pause-fill"></i></a>
            @endif
        @endcan
        @can('cancel', $campaign)
            @if (!$campaign->canceled())
                <a href="javascript:void(0);" class="icon-btn toggle-cancel" data-tippy-content="{{ __('buttons.cancel_campaign') }}"><i class="bi-x-circle"></i></a>
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
        $.getModal('App\\Http\\Controllers\\Campaigns\\CampaignObjectiveController@addObjectives', {campaign_id: campaign_id});
    });
    $('.add-users').on('click', function() {
        $.getModal('App\\Http\\Controllers\\Campaigns\\CampaignUserController@addUsers', {id: campaign_id});
    });
    $('.edit-objective').on('click', function() {
        var model_id = $(this).attr('data-modelid');

        if(model_id && model_id !== ''){
            $.getModal('App\\Http\\Controllers\\Campaigns\\CampaignObjectiveController@addObjectives', {id: model_id});
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

    $('.toggle-terminate').on('click', function() {
        var dataurl = $(this).attr('data-url');
        var uc = $(this).parents('li').first();
        $.confirm('Czy na pewno zawieścić tą kampanię? Użytkownicy przestaną widzieć cele przypisane w ramach tej kampanii, a administratorzy nie będą mogli dodawać nowych celów.', null, function() {
            // $.jsonAjax(dataurl, {}, function(response) {
            //     uc.remove();
            //     $.success(response.message);
            // }, function(response){
            //     $.error(response.message);
            // }, 'DELETE' );
        });
    });

    $('.toggle-cancel').on('click', function() {
        var dataurl = $(this).attr('data-url');
        var uc = $(this).parents('li').first();
        $.confirm('Czy na pewno zawieścić tą kampanię? Wszelkie operacje przestaną być aktywne oraz znikną z agendy pozostałych użytkowników. Kampania pozostanie widoczna wyłącznie w celach archiwalnych. Operacja jest nieodwracalna!', null, function() {
            // $.jsonAjax(dataurl, {}, function(response) {
            //     uc.remove();
            //     $.success(response.message);
            // }, function(response){
            //     $.error(response.message);
            // }, 'DELETE' );
        });
    });
</script>
@endpush
