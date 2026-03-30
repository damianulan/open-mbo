@props([
    'userObjective',
])

@php
    $objective = $userObjective->getRelation('objective');
    $objective?->loadMissing([
        'campaign',
        'category',
    ]);
    $campaign = $objective?->campaign;
    $gainedPoints = (float) ($userObjective->gained_points ?? 0);
    $showWarningDeadline = $objective?->isOverdued() && ! $userObjective->isCompleted();
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
                    <span class="badge {{ $showWarningDeadline ? 'bg-warning text-dark' : 'bg-light text-dark border' }}">
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
