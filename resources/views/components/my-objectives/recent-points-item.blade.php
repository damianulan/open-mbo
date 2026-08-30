@props([
    'points',
])

@php
    $subjectLabel = class_basename($points->subject_type);
    $subjectUrl = null;

    if ($points->subject instanceof \App\Models\Mbo\UserObjective) {
        $subjectLabel = $points->subject->objective?->name ?? $subjectLabel;
        $subjectUrl = route('objectives.assignment.show', $points->subject);
    }

    if ($points->subject instanceof \App\Models\Mbo\UserCampaign) {
        $subjectLabel = $points->subject->campaign?->name ?? $subjectLabel;
        $subjectUrl = route('campaigns.users.show', ['userCampaign' => $points->subject->uuid]);
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
