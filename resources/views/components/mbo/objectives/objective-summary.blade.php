<div class="content-card">
    <div class="content-card-top">
        <div class="content-card-header">
            <i class="bi-crosshair me-1"></i>
            <span>{{ $objective->name }}</span>
        </div>
        @if($objective->category()->exists())
            <div data-tippy-content="{{ __('fields.category') }}" class="align-self-center mx-2">
                <span class="badge bg-secondary">{{ $objective->category->name }}</span>
            </div>
        @endif
        <div class="content-card-icons ms-auto">
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
                <div class="text-{{ $warning }}" data-tippy-content="{{ __('alerts.objectives.error.overdued', ['term' => $objective->deadline->diffForHumans()]) }}">
                    <i class="bi-exclamation-diamond-fill"></i>
                </div>
            @endif
        </div>
    </div>
    <div class="content-card-body">
        <div class="py-2">{!! $objective->description !!}</div>

        <div class="content-card-icons text-secondary fw-bold pb-2">
            <div class="icon-badge" data-tippy-content="{{ __('forms.mbo.objectives.weight') }}">
                <i class="bi-minecart-loaded"></i>
                <span>{{ float_view($objective->weight) }}</span>
            </div>
            @if($objective->expected)
                <div class="icon-badge" data-tippy-content="{{ __('forms.mbo.objectives.expected') }}">
                    <i class="bi-patch-check"></i>
                    <span>{{ float_view($objective->expected) }}</span>
                </div>
            @endif
            @if(!$userObjective->exists)
                @if($objective->award)
                    <div class="icon-badge" data-tippy-content="{{ __('forms.mbo.objectives.award') }}">
                        <i class="bi-award"></i>
                        <span>{{ float_view($objective->award) . '' . __('globals.pnts') }}</span>
                    </div>
                @endif
            @else
                @if($objective->award)
                    <div class="icon-badge" data-tippy-content="{{ __('forms.mbo.objectives.award') }}">
                        <i class="bi-award"></i>
                        <span>{!! ($userObjective->points && $userObjective->points->points ? '<span class="text-success fs-4">' .float_view($userObjective->points->points) . '</span> / ' :'') . float_view($objective->award) . '' . __('globals.pnts') !!}</span>
                    </div>
                @endif
                <div class="icon-badge ms-auto" data-tippy-content="{{ __('forms.mbo.objectives.users.realization') }}">
                    <i class="bi-check-circle"></i>
                    <span>{{ float_view($userObjective->realization) }}</span>
                </div>
                <div class="icon-badge" data-tippy-content="{{ __('forms.mbo.objectives.users.evaluation') }}">
                    <i class="bi-shield-check"></i>
                    <span>{{ percent_view(float_view($userObjective->evaluation)) }}</span>
                </div>
            @endif
        </div>
        <div class="content-card-icons">
            @if($objective->deadline)
                <div class="mb-3" data-tippy-content="{{ __('forms.mbo.objectives.deadline_to', ['term' => $objective->deadline->diffForHumans()]) }}">
                    <span class="badge {{ $objective->isOverdued() ? 'bg-'.$warning:'bg-secondary' }}">{{ $objective->deadline->format(config('app.datetime_format')) }}</span>
                </div>
            @endif
        </div>
        @if($userObjective->exists)
            <div class="content-card-icons">
                @if($userObjective->exists)
                    <div class="badge badge-{{ $userObjective->status }} fs-6" data-tippy-content="{{ __('forms.mbo.objectives.status') }}">{{ __('mbo.objective'). ' ' .mb_strtolower($userObjective->getStatusLabel()) }}</div>
                @endif
            </div>
            <div class="content-card-btns flex-wrap">
                @if($userObjective->canBePassed())
                    <a href="{{ route('objectives.assignment.pass', $userObjective->id) }}" class="btn btn-outline-success mt-3"><i class="bi-btn bi-check2-circle"></i>{{ __('mbo.objectives.pass') }}</a>
                @endif
                @if($userObjective->canBeFailed())
                    <a href="{{ route('objectives.assignment.fail', $userObjective->id) }}" class="btn btn-outline-danger mt-3"><i class="bi-btn bi-x-lg"></i>{{ __('mbo.objectives.fail') }}</a>
                @endif
            </div>
        @endif
    </div>

</div>
