<div class="content-card">
    <div class="content-card-top">
        <div class="content-card-header">
            <i class="bi-crosshair me-1"></i>
            <span>{{ $objective->name }}</span>
        </div>
        @if($objective->category()->exists())
            <div data-tippy-content="{{ __('fields.category') }}" class="align-self-center ms-2">
                <span class="badge bg-secondary">{{ $objective->category->name }}</span>
            </div>
        @endif
        <div class="content-card-icons ms-auto fw-bold">
            @if($objective->campaign()->exists())
                <a href={{ route('campaigns.show', $objective->campaign->id) }} data-tippy-content="{{ __('mbo.info.campaign_related', ['campaign' => $objective->campaign->name, 'period' => $objective->campaign->period]) }}">
                    <i class="bi-bullseye"></i>
                </a>
            @endif
            @if($objective->draft)
                <div data-tippy-content="{{ __('forms.mbo.objectives.info.draft') }}">
                    <i class="bi-feather"></i>
                </div>
            @endif
            @if($objective->isOverdued())
                <div class="text-{{ $warning }}" data-tippy-content="{{ __('alerts.objectives.error.overdued') }}">
                    <i class="bi-exclamation-diamond-fill"></i>
                </div>
            @endif
        </div>
    </div>
    <div class="py-2">{!! $objective->description->get() !!}</div>

    <div class="content-card-icons text-secondary fw-bold pb-2">
        <div data-tippy-content="{{ __('forms.mbo.objectives.weight') }}">
            <i class="bi-minecart-loaded"></i>
            <span>{{ float_view($objective->weight) }}</span>
        </div>
        @if($objective->expected)
            <div data-tippy-content="{{ __('forms.mbo.objectives.expected') }}">
                <i class="bi-patch-check"></i>
                <span>{{ float_view($objective->expected) }}</span>
            </div>
        @endif
        @if($objective->award)
            <div data-tippy-content="{{ __('forms.mbo.objectives.award') }}">
                <i class="bi-award"></i>
                <span>{{ float_view($objective->award) . '' . __('globals.pnts') }}</span>
            </div>
        @endif
        @if($objective->deadline)
            <div data-tippy-content="{{ __('forms.mbo.objectives.deadline') }}">
                <span class="badge {{ $objective->isOverdued() ? 'bg-'.$warning:'bg-secondary' }}">{{ $objective->deadline }}</span>
            </div>
        @endif
        @if($userObjective->exists)
            <div class="ms-auto" data-tippy-content="{{ __('forms.mbo.objectives.users.realization') }}">
                <i class="bi-check-circle"></i>
                <span>{{ float_view($userObjective->realization) }}</span>
            </div>
            <div data-tippy-content="{{ __('forms.mbo.objectives.users.evaluation') }}">
                <i class="bi-shield-check"></i>
                <span>{{ percent_view(float_view($userObjective->evaluation)) }}</span>
            </div>
        @endif
    </div>
    @if($userObjective->exists)
        <div class="content-card-icons mb-3">
            <div class="badge badge-{{ $userObjective->status }} fs-6" data-tippy-content="{{ __('forms.mbo.objectives.status') }}">{{ __('mbo.objective'). ' ' .strtolower($userObjective->getStatusLabel()) }}</div>
        </div>
        <div class="content-card-btns">
            @if($userObjective->canBePassed())
                <a href="{{ route('mbo.objectives.assignment.pass', $userObjective->id) }}" class="btn btn-outline-primary"><i class="bi-btn bi-check2-circle"></i>{{ __('mbo.objectives.pass') }}</a>
            @endif
            @if($userObjective->canBeFailed())
                <a href="{{ route('mbo.objectives.assignment.fail', $userObjective->id) }}" class="btn btn-outline-primary"><i class="bi-btn bi-x-lg"></i>{{ __('mbo.objectives.fail') }}</a>
            @endif
        </div>
    @endif
</div>
