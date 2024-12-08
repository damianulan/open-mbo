@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn" href="{{ route('campaigns.edit', $campaign->id) }}" data-tippy-content="{{ __('buttons.edit') }}"><i class="bi-pencil-fill"></i></a>
        <a href="javascript:void(0);" class="icon-btn add-objective" data-tippy-content="{{ __('Dodaj cele') }}"><i class="bi-heart-arrow"></i></a>
        <a href="javascript:void(0);" class="icon-btn add-users" data-tippy-content="{{ __('Zapisz użytkowników') }}"><i class="bi-person-fill-up"></i></a>
    </div>
</div>
<div class="content-card">
    <div class="row">
        <div class="col-md-12">
            {!! $campaign->description->get() !!}
        </div>
    </div>
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5 pt-3">
                <h4>Cele</h4>
                <ul class="ombo-list">
                    @if(count($campaign->objectives))
                        @foreach ($campaign->objectives as $objective)
                        <li>
                            <div class="list-grid">
                                <div class="list-content">
                                    <i class="bi text-primary bi-bullseye me-1"></i>
                                    <span>{{ $objective->name }}</span>
                                </div>
                                <div class="list-actions">
                                    @if($objective->draft)
                                    <div class="list-action me-3" data-tippy-content="{{ __('forms.objectives.info.draft') }}">
                                        <i class="bi-feather"></i>
                                    </div>
                                    @endif
                                    <div class="list-action me-3" data-tippy-content="Waga celu">
                                        <i class="bi-minecart-loaded"></i>
                                        <span>{{ $objective->weight }}</span>
                                    </div>
                                    @if($objective->expected)
                                    <div class="list-action me-3" data-tippy-content="{{ __('forms.objectives.expected') }}">
                                        <i class="bi-heart-arrow"></i>
                                        <span>{{ $objective->expected }}</span>
                                    </div>
                                    @endif
                                    <a href="javascript:void(0);" class="list-action edit-objective" data-modelid="{{ $objective->id }}" data-tippy-content="Edytuj">
                                        <i class="bi-pencil-fill"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-oid="{{ $objective->id }}" class="list-action delete-objective" data-tippy-content="Usuń">
                                        <i class="bi-x-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    @endif

                </ul>
            </div>
            <div class="col-md-5 offset-md-2 pt-3">
                <h4>Zapisani użytkownicy</h4>
                @if(count($campaign->user_campaigns))
                <ul class="ombo-list">
                    @foreach ($campaign->user_campaigns as $uc)
                    @php
                      $user = $uc->user;
                    @endphp
                    <li>
                        <div class="list-grid">
                            <div class="list-content">
                                <i class="bi text-primary bi-person me-1"></i>
                                <span>{{ $user->name() }}</span>
                            </div>
                            <div class="list-actions">
                                <div class="list-action me-2" data-tippy-content="{{ $uc->stageDescription() }}">
                                    <i class="{{ $uc->stageIcon() }}"></i>
                                </div>
                                @if($uc->manual)
                                <a href="javascript:void(0);" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Przesuń do poprzedniego etapu">
                                    <i class="bi-caret-down-fill"></i>
                                </a>
                                <a href="javascript:void(0);" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Przesuń do następnego etapu">
                                    <i class="bi-caret-up-fill"></i>
                                </a>
                                <a href="javascript:void(0);" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Wyłącz tryb ręczny">
                                    <i class="bi-hand-index-thumb-fill"></i>
                                </a>
                                @else
                                <a href="javascript:void(0);" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Włącz tryb ręczny">
                                    <i class="bi-hand-index-thumb"></i>
                                </a>
                                @endif
                                <a href="javascript:void(0);" class="list-action" data-ucid="{{ $uc->id }}">
                                    <i class="bi-x-lg"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
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

        $.getModal('campaigns.add_objectives', {id: model_id});
    });
</script>
@endsection
