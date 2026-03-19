@extends('layouts.portal.master')
@section('content')
@php
    $totalObjectivesCount = $userObjectives->count();
@endphp

<div class="d-flex flex-column gap-3">
    <section>
        <h2 class="text-serif mb-1">{{ __('globals.hello') }}, {{ $user->firstname }}</h2>
    </section>

    <section class="row g-3">
        <x-my-objectives.stat-card :label="__('pages.home.my_objectives')" :value="$totalObjectivesCount" />
        <x-my-objectives.stat-card :label="__('fields.current')" :value="$activeObjectivesCount" />
        <x-my-objectives.stat-card :label="__('forms.campaigns.info.completed')" :value="$completedObjectivesCount" />
        <x-my-objectives.stat-card
            :label="__('pages.home.my_points')"
            :value="float_view($totalPoints) . __('globals.pnts')"
            value-class="text-highlight"
        />
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
                                <x-my-objectives.objective-item :user-objective="$userObjective" />
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
                                <x-my-objectives.recent-points-item :points="$points" />
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
