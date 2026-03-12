<div class="content-card">
    <div class="content-card-top">
        <div class="content-card-header">
            <i class="bi-bullseye"></i>
            <span>{{ $userCampaign->campaign->name }} [{{ $userCampaign->campaign->period }}]</span>
        </div>
        <div class="content-card-icons ms-auto">
            <div data-tippy-content="{{ $userCampaign->stageDescription() }}">
                <i class="{{ $userCampaign->stageIcon() }}"></i>
            </div>
            @if($userCampaign->isManual())
                <div data-tippy-content="{{ __('mbo.info.manual_on') }}">
                    <i class="bi-hand-index-thumb{{ $userCampaign->manual ? '-fill' : '' }}"></i>
                </div>
            @endif
            @if(! $userCampaign->active)
                <div data-tippy-content="{{ __('globals.inactive') }}">
                    <i class="bi-pause-circle-fill"></i>
                </div>
            @endif
        </div>
    </div>
    <div class="content-card-body">
        <div class="user" data-tippy-content="{{ $userCampaign->user->name }}">
            {!! $userCampaign->user->nameDetails() !!}
        </div>

        <div class="content-card-icons text-secondary fw-bold pt-3 flex-wrap">
            <div class="icon-badge" data-tippy-content="{{ __('mbo.objectives.index') }}">
                <i class="bi-crosshair"></i>
                <span>{{ $objectivesCount }}</span>
            </div>
            <div class="icon-badge" data-tippy-content="{{ __('mbo.completed') }}">
                <i class="bi-check2-square"></i>
                <span>{{ $objectivesFinishedCount }}</span>
            </div>
            <div class="icon-badge" data-tippy-content="{{ __('mbo.evaluated') }}">
                <i class="bi-shield-check"></i>
                <span>{{ $objectivesEvaluatedCount }}</span>
            </div>

            <div class="ms-auto d-flex gap-2 flex-wrap">
                @foreach(\App\Enums\MBO\UserObjectiveStatus::labels() as $status => $label)
                    @php
                        $count = $objectiveStatusCounts[$status] ?? 0;
                    @endphp
                    @if($count)
                        <div class="badge badge-{{ $status }} fs-6" data-tippy-content="{{ $label }}">{{ $count }}</div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
