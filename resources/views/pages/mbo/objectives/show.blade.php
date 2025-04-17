@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn edit-objective" href="javascript:void(0);" data-modelid="{{ $objective->id }}" data-tippy-content="{{ __('buttons.edit') }}"><i class="bi-pencil-fill"></i></a>
        <a href="javascript:void(0);" class="icon-btn add-child-objective" data-modelid="{{ $objective->id }}" data-tippy-content="{{ __('Dodaj cele podrzędne') }}"><i class="bi-crosshair"></i></a>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 col-lg-9 col-md-12 pb-4">
        <div class="content-card">
            <div class="content-card-top">
                <div class="content-card-title">
                    <i class="bi-crosshair me-1"></i>
                    <span>{{ $objective->name }}</span>
                </div>
                @if($objective->category)
                    <div data-tippy-content="{{ __('fields.category') }}" class="align-self-center ms-2">
                        <span class="badge bg-secondary">{{ $objective->category->name }}</span>
                    </div>
                @endif
                <div class="content-card-icons ms-auto fw-bold">
                    @if($objective->campaign)
                        <a href={{ route('campaigns.show', $objective->campaign->id) }} data-tippy-content="{{'Cel powiązany z kampanią: ' . $objective->campaign->name . ' [' . $objective->campaign->period . ']' }}">
                            <i class="bi-bullseye"></i>
                        </a>
                    @endif
                    @if($objective->draft)
                        <div data-tippy-content="{{ __('forms.mbo.objectives.info.draft') }}">
                            <i class="bi-feather"></i>
                        </div>
                    @endif
                    @if($objective->isOverdued())
                        <div class="text-danger" data-tippy-content="{{ __('alerts.objectives.error.overdued') }}">
                            <i class="bi-exclamation-diamond-fill"></i>
                        </div>
                    @endif

                </div>
            </div>
            <div class="my-3">{!! $objective->description->get() !!}</div>
            <div class="content-card-icons text-secondary fw-bold">
                    <div data-tippy-content="Waga celu">
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
                        <span>{{ float_view($objective->award) . '' . __('vocabulary.pnts') }}</span>
                    </div>
                @endif
                @if($objective->deadline)
                    <div data-tippy-content="{{ __('forms.mbo.objectives.deadline') }}">
                        <span class="badge {{ $objective->isOverdued() ? 'bg-danger':'bg-secondary' }}">{{ $objective->deadline }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-3 col-md-12 pb-4">
        <div class="content-card">
            <div class="content-card-top">
                <div class="content-card-title">
                    <i class="bi-person-fill-gear me-1"></i>
                    <span>{{ __('mbo.objective_admins') }}</span>
                    <i class="info-box bi-info-circle-fill ms-1" data-tippy-content="{{ __('mbo.info.objective_admins') }}"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if($objective->coordinators()->count())
                        <ul class="ombo-list">
                            @foreach ($objective->coordinators()->get() as $user)
                            @if($user)
                                <li>
                                    <div class="list-grid">
                                        <div class="list-content">
                                            <div class="nowrap user" data-tippy-content="{{ $user->name() }}">
                                                {!! $user->nameDetails() !!}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @endforeach
                        </ul>

                    @else
                        <div><p class="text-primary">{{ __('mbo.info.no_category_admins_added') }}</p></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12 pb-4">
        <div class="content-card">
            <div class="content-card-top">
                <div class="content-card-title">
                    <i class="bi-person-fill-up me-1"></i>
                    <span>{{ __('W trakcie realizacji celu') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if($objective->user_assignments()->count())
                        <ul class="ombo-list">
                            @foreach ($objective->user_assignments as $ua)
                            @php
                            $user = $ua->user;
                            @endphp
                            @if($user)
                                <li>
                                    <div class="list-grid">
                                        <div class="list-content">
                                            <div class="nowrap user" data-tippy-content="{{ $user->name() }}">
                                                {!! $user->nameDetails() !!}
                                            </div>
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
    <div class="col-lg-6 col-md-12 pb-4">
        <div class="content-card">
            <div class="content-card-top">
                <div class="content-card-title">
                    <i class="bi-person-fill-down me-1"></i>
                    <span>{{ __('Podejścia zakończone') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('page-scripts')
<script type="text/javascript">
    $('.edit-objective').on('click', function() {
        var model_id = $(this).attr('data-modelid');

        if(model_id && model_id !== ''){
            $.getModal('campaigns.add_objectives', {id: model_id});
        }
    });

    $('.add-child-objective').on('click', function() {
        var parent_id = $(this).attr('data-modelid');

        if(parent_id && parent_id !== ''){
            $.getModal('objectives.add_child', {parent_id: parent_id});
        }
    });
</script>
@endsection
