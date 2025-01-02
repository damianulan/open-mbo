@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn" href="{{ route('campaigns.edit', $campaign->id) }}" data-tippy-content="{{ __('buttons.edit') }}"><i class="bi-pencil-fill"></i></a>
        <a href="javascript:void(0);" class="icon-btn add-objective" data-tippy-content="{{ __('mbo.buttons.add_objective') }}"><i class="bi-heart-arrow"></i></a>
        <a href="javascript:void(0);" class="icon-btn add-users" data-tippy-content="{{ __('buttons.enrol_users') }}"><i class="bi-person-fill-up"></i></a>
    </div>
</div>
<div class="content-card">
    @include('components.mbo.campaign-summary')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 pt-3">
                <h4>{{ __('mbo.objectives') }}</h4>
                    @if(count($campaign->objectives))
                        <ul class="ombo-list">
                            @foreach ($campaign->objectives as $objective)
                            <li>
                                <div class="list-grid">
                                    <div class="list-content">
                                        <div class="nowrap" data-tippy-content="{{ $objective->name }}">
                                            <i class="bi text-primary bi-heart-arrow me-1"></i>
                                            <span>{{ $objective->name }}</span>
                                        </div>

                                    </div>
                                    <div class="list-actions">
                                        @if($objective->draft)
                                        <div class="list-action me-3" data-tippy-content="{{ __('forms.mbo.objectives.info.draft') }}">
                                            <i class="bi-feather"></i>
                                        </div>
                                        @endif
                                        <div class="list-action me-3" data-tippy-content="Waga celu">
                                            <i class="bi-minecart-loaded"></i>
                                            <span>{{ $objective->weight }}</span>
                                        </div>
                                        @if($objective->expected)
                                        <div class="list-action me-3" data-tippy-content="{{ __('forms.mbo.objectives.expected') }}">
                                            <i class="bi-patch-check"></i>
                                            <span>{{ $objective->expected }}</span>
                                        </div>
                                        @endif
                                        <a href="{{ route('objectives.show', $objective->id) }}" class="list-action" data-modelid="{{ $objective->id }}" data-tippy-content="{{ __('buttons.summary') }}">
                                            <i class="bi-eye-fill"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="list-action edit-objective" data-modelid="{{ $objective->id }}" data-tippy-content="{{ __('buttons.edit') }}">
                                            <i class="bi-pencil-fill"></i>
                                        </a>
                                        <a href="javascript:void(0);" data-url="{{ route('campaigns.objective.delete', $objective->id) }}" class="list-action delete-objective" data-tippy-content="{{ __('buttons.delete') }}">
                                            <i class="bi-x-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            @endforeach
                        </ul>

                    @else
                        <div>
                            <p class="text-primary">{{ __('mbo.info.no_objectives_added') }}</p>
                        </div>
                    @endif

            </div>
            <div class="col-md-5 offset-md-2 pt-3">
                <h4>{{ __('mbo.enroled_users') }}</h4>
                @if($campaign->user_campaigns()->count())
                    <ul class="ombo-list">
                        @foreach ($campaign->user_campaigns as $uc)
                        @php
                        $user = $uc->user;
                        @endphp
                        @if($user)
                            <li>
                                <div class="list-grid">
                                    <div class="list-content">
                                        <div class="nowrap user" data-tippy-content="{{ $user->name() }}">
                                            {!! $user->nameDetails() !!}
                                        </div>
                                    </div>
                                    <div class="list-actions">
                                        <div class="list-action me-2" data-tippy-content="{{ $uc->stageDescription() }}">
                                            <i class="{{ $uc->stageIcon() }}"></i>
                                        </div>
                                        <a href="" class="list-action me-2" data-modelid="{{ $uc->id }}" data-tippy-content="{{ __('buttons.summary') }}">
                                            <i class="bi-eye-fill"></i>
                                        </a>
                                        @if($uc->manual)
                                        <a href="{{ route('campaigns.users.prev_stage', $uc->id) }}" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Przesuń do poprzedniego etapu">
                                            <i class="bi-caret-left-fill"></i>
                                        </a>
                                        <a href="{{ route('campaigns.users.next_stage', $uc->id) }}" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Przesuń do następnego etapu">
                                            <i class="bi-caret-right-fill"></i>
                                        </a>
                                        <a href="{{ route('campaigns.users.toggle_manual', $uc->id) }}" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Wyłącz tryb ręczny">
                                            <i class="bi-hand-index-thumb-fill"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('campaigns.users.toggle_manual', $uc->id) }}" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Włącz tryb ręczny">
                                            <i class="bi-hand-index-thumb"></i>
                                        </a>
                                        @endif
                                        <a class="user-delete" href="javascript:void(0);" class="list-action" data-url="{{ route('campaigns.users.delete', $uc->id) }}">
                                            <i class="bi-x-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endif
                        @endforeach
                    </ul>

                @else
                    <div><p class="text-primary">{{ __('mbo.info.no_users_added') }}</p></div>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
@section('page-scripts')
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
</script>
@endsection
