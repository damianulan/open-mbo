@extends('layouts.portal.master')
@section('content')

<div>
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-serif">{{ __('globals.hello') }}, {{ auth()->user()->firstname }}</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="content-card content-card-sm">
            <div class="content-card-top">
                <div class="content-card-header">
                    <i class="bi-clipboard-check-fill me-2"></i>
                    <div>{{ __('pages.home.my_objectives') }}</div>
                </div>
                <div class="content-card-icons ms-auto">
                    <i class="minimize"></i>
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

                @if($userObjectives->count())
                    <ul class="ombo-list">
                        @foreach($userObjectives as $userObjective)
                            @php
                                $objective = $userObjective->getRelation('objective');
                                $statusColor = $objective ? $userObjective->getStatusColor() : '';
                            @endphp
                            <li class="{{ $statusColor }}">
                                <div class="list-grid">
                                    <div class="list-content">
                                        <div class="nowrap d-flex gap-2 align-items-center" data-tippy-content="{{ $objective?->name ?? '-' }}">
                                            <i class="bi text-primary {{ $objective?->campaign_id ? 'bi-bullseye':'bi-crosshair' }}"></i>
                                            <div>{{ $objective?->name ?? '-' }}</div>
                                            <div class="ms-auto">
                                                <span class="badge badge-{{ $userObjective->status }}">{{ $userObjective->getStatusLabel() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-actions">
                                        @if($userObjective->evaluation)
                                            <div class="list-action" data-tippy-content="{{ __('forms.mbo.objectives.evaluation') }}">
                                                <span>{{ percent_view($userObjective->evaluation) }}</span>
                                            </div>
                                        @endif
                                        @if($objective?->award)
                                            <div class="list-action" data-tippy-content="{{ __('forms.mbo.objectives.award') }}">
                                                <x-icon key="award" />
                                                <span>{{ float_view($userObjective->points?->points ?? 0) }} / {{ float_view($objective->award) }}{{ __('globals.pnts') }}</span>
                                            </div>
                                        @endif
                                        @if($objective?->deadline)
                                            <div class="list-action" data-tippy-content="{{ __('forms.mbo.objectives.deadline_to', ['term' => $objective->deadline->format(config('app.datetime_format'))]) }}">
                                                <x-icon key="calendar2-week-fill" />
                                            </div>
                                        @endif
                                        <a href="{{ route('objectives.assignment.show', $userObjective->id) }}" class="list-action" data-tippy-content="{{ __('buttons.preview') }}">
                                            <x-icon key="eye-fill" />
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div><p class="text-primary">{{ __('mbo.info.no_objectives_added') }}</p></div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-12">
        <div class="content-card content-card-sm">
            <div class="content-card-top">
                <div class="content-card-header">
                    <i class="bi-award-fill me-2"></i>
                    <div>{{ __('pages.home.my_points') }}</div>
                </div>
                <div class="content-card-icons ms-auto">
                    <i class="minimize"></i>
                </div>
            </div>
            <div class="content-card-body">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="text-secondary">{{ __('fields.points') }}:</div>
                    <div class="text-highlight fw-bold fs-4">{{ float_view($totalPoints) }}{{ __('globals.pnts') }}</div>
                </div>

                @if($recentPoints->count())
                    <div class="table-responsive">
                        <table class="table table-sm table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>{{ __('fields.created_at') }}</th>
                                    <th>{{ __('fields.points') }}</th>
                                    <th>{{ __('fields.subject') }}</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                    <tr>
                                        <td>{{ $points->created_at?->format(config('app.datetime_format')) ?? '-' }}</td>
                                        <td>{{ float_view($points->points ?? 0) }}{{ __('globals.pnts') }}</td>
                                        <td>
                                            @if($subjectUrl)
                                                <a href="{{ $subjectUrl }}">{{ $subjectLabel }}</a>
                                            @else
                                                {{ $subjectLabel }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-muted">{{ __('globals.no_data') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="content-card content-card-sm">
            <div class="content-card-top">
                <div class="content-card-header">
                    <i class="bi-bullseye me-2"></i>
                    <div>{{ __('pages.home.my_campaigns') }}</div>
                </div>
                <div class="content-card-icons ms-auto">
                    <i class="minimize"></i>
                </div>
            </div>
            <div class="content-card-body">
                @if($userCampaigns->count())
                    <div class="row g-3">
                        @foreach($userCampaigns as $userCampaign)
                            @php
                                $campaign = $userCampaign->getRelation('campaign');
                            @endphp
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                @if($campaign)
                                    <x-campaign-card :campaign="$campaign" :userCampaign="$userCampaign" />
                                @else
                                    <div class="text-muted">{{ __('globals.not_applicable') }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-muted">{{ __('globals.no_data') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
@endpush
