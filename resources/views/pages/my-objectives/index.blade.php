@extends('layouts.portal.master')
@section('content')
<div class="d-flex flex-column gap-3">
    <section>
        <h2 class="text-serif mb-1">{{ __('globals.hello') }}, {{ $user->firstname }}</h2>
    </section>

    <section class="row g-3">
        <div class="col-6 col-xl-3">
            <div class="content-card content-card-sm h-100">
                <div class="content-card-body">
                    <div class="text-muted small">{{ __('pages.home.my_objectives') }}</div>
                    <div class="fs-3 fw-bold">{{ $userObjectives->count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="content-card content-card-sm h-100">
                <div class="content-card-body">
                    <div class="text-muted small">{{ __('fields.current') }}</div>
                    <div class="fs-3 fw-bold">{{ $activeObjectivesCount }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="content-card content-card-sm h-100">
                <div class="content-card-body">
                    <div class="text-muted small">{{ __('forms.campaigns.info.completed') }}</div>
                    <div class="fs-3 fw-bold">{{ $completedObjectivesCount }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="content-card content-card-sm h-100">
                <div class="content-card-body">
                    <div class="text-muted small">{{ __('pages.home.my_points') }}</div>
                    <div class="fs-3 fw-bold text-highlight">{{ float_view($totalPoints) }}{{ __('globals.pnts') }}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="row g-3 align-items-start">
        <div class="col-12 col-xl-8">
            <div class="content-card content-card-sm">
                <div class="content-card-top">
                    <div class="content-card-header">
                        <i class="bi-clipboard-check-fill me-2"></i>
                        <div>{{ __('pages.home.my_objectives') }}</div>
                    </div>
                </div>
                <div class="content-card-body">
                    @if($objectiveStatusCounts->count())
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @foreach($objectiveStatusCounts as $status => $count)
                                <span class="badge badge-{{ $status }}">{{ __('mbo.objective_status.' . $status) }}: {{ $count }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if($userObjectives->isEmpty())
                        <p class="text-primary mb-0">{{ __('mbo.info.no_objectives_added') }}</p>
                    @else
                        <div class="d-grid gap-3">
                            @foreach($userObjectives as $userObjective)
                                @php
                                    $objective = $userObjective->getRelation('objective');
                                    $campaign = $objective?->campaign;
                                    $gainedPoints = (float) ($userObjective->gained_points ?? 0);
                                @endphp

                                <article class="border rounded-3 p-3 h-100">
                                    <div class="d-flex flex-column flex-md-row gap-3 align-items-start">
                                        <div class="flex-grow-1 min-w-0">
                                            <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                                                <i class="bi text-primary {{ $objective?->campaign_id ? 'bi-bullseye' : 'bi-crosshair' }}"></i>
                                                <a href="{{ route('objectives.assignment.show', $userObjective->id) }}" class="fw-semibold text-reset text-decoration-none">
                                                    {{ $objective?->name ?? '-' }}
                                                </a>
                                                <span class="badge badge-{{ $userObjective->status }}">{{ $userObjective->getStatusLabel() }}</span>
                                            </div>

                                            @if($objective?->description)
                                                <div class="text-muted small mb-3">
                                                    {{ str(strip_tags($objective->description))->squish()->limit(180) }}
                                                </div>
                                            @endif

                                            <div class="d-flex flex-wrap gap-2">
                                                @if($objective?->category)
                                                    <span class="badge bg-secondary">{{ $objective->category->name }}</span>
                                                @endif

                                                @if($campaign)
                                                    <span class="badge bg-light text-dark border">{{ $campaign->name }}{{ $campaign->period ? ' · ' . $campaign->period : '' }}</span>
                                                @endif

                                                @if($userObjective->evaluation)
                                                    <span class="badge bg-light text-dark border">
                                                        {{ __('forms.mbo.objectives.evaluation') }}: {{ percent_view($userObjective->evaluation) }}
                                                    </span>
                                                @endif

                                                @if($objective?->award)
                                                    <span class="badge bg-light text-dark border">
                                                        {{ __('forms.mbo.objectives.award') }}: {{ float_view($gainedPoints) }} / {{ float_view($objective->award) }}{{ __('globals.pnts') }}
                                                    </span>
                                                @endif

                                                @if($objective?->deadline)
                                                    <span class="badge {{ $objective->isOverdued() && ! $userObjective->isCompleted() ? 'bg-warning text-dark' : 'bg-light text-dark border' }}">
                                                        {{ $objective->deadline->format(config('app.datetime_format')) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="w-100 d-grid d-md-block">
                                            <a href="{{ route('objectives.assignment.show', $userObjective->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye-fill me-1"></i>{{ __('buttons.preview') }}
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="content-card content-card-sm">
                <div class="content-card-top">
                    <div class="content-card-header">
                        <i class="bi-award-fill me-2"></i>
                        <div>{{ __('pages.home.my_points') }}</div>
                    </div>
                </div>
                <div class="content-card-body">
                    <div class="border rounded-3 p-3 mb-3">
                        <div class="text-muted small">{{ __('fields.points') }}</div>
                        <div class="fs-3 fw-bold text-highlight">{{ float_view($totalPoints) }}{{ __('globals.pnts') }}</div>
                    </div>

                    @if($recentPoints->isEmpty())
                        <div class="text-muted">{{ __('globals.no_data') }}</div>
                    @else
                        <div class="d-grid gap-2">
                            @foreach($recentPoints as $points)
                                @php
                                    $subjectLabel = class_basename($points->subject_type);
                                    $subjectUrl = null;

                                    if ($points->subject instanceof \App\Models\MBO\UserObjective) {
                                        $subjectLabel = $points->subject->objective?->name ?? $subjectLabel;
                                        $subjectUrl = route('objectives.assignment.show', $points->subject->id);
                                    }

                                    if ($points->subject instanceof \App\Models\MBO\UserCampaign) {
                                        $subjectLabel = $points->subject->campaign?->name ?? $subjectLabel;
                                        $subjectUrl = route('campaigns.users.show', $points->subject->id);
                                    }
                                @endphp

                                <div class="border rounded-3 p-3">
                                    <div class="d-flex justify-content-between gap-3 align-items-start">
                                        <div class="min-w-0">
                                            <div class="text-muted small mb-1">{{ $points->created_at?->format(config('app.datetime_format')) ?? '-' }}</div>
                                            @if($subjectUrl)
                                                <a href="{{ $subjectUrl }}" class="fw-semibold text-reset text-decoration-none">{{ $subjectLabel }}</a>
                                            @else
                                                <div class="fw-semibold">{{ $subjectLabel }}</div>
                                            @endif
                                        </div>
                                        <span class="badge bg-success">+{{ float_view($points->points ?? 0) }}{{ __('globals.pnts') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="content-card content-card-sm">
        <div class="content-card-top">
            <div class="content-card-header">
                <i class="bi-bullseye me-2"></i>
                <div>{{ __('pages.home.my_campaigns') }}</div>
            </div>
        </div>
        <div class="content-card-body">
            @if($userCampaigns->isEmpty())
                <div class="text-muted">{{ __('globals.no_data') }}</div>
            @else
                <div class="row g-3">
                    @foreach($userCampaigns as $userCampaign)
                        @php
                            $campaign = $userCampaign->campaign;
                        @endphp
                        <div class="col-12 col-md-6 col-xl-4">
                            @if($campaign)
                                <x-campaign-card :campaign="$campaign" :userCampaign="$userCampaign" />
                            @else
                                <div class="text-muted">{{ __('globals.not_applicable') }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
