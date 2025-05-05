@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn edit-objective" href="javascript:void(0);" data-modelid="" data-tippy-content="{{ __('buttons.edit') }}"><i class="bi-pencil-fill"></i></a>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-md-12 pb-4">
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
                        <span>{{ float_view($objective->award) . '' . __('globals.pnts') }}</span>
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
    @if($objective->coordinators())
        <div class="col-xl-6 pb-4">
            <div class="content-card">
                <div class="content-card-top">
                    <div class="content-card-header">
                        <i class="bi-person-fill-gear me-1"></i>
                        <span>{{ __('Realizacja celu') }}</span>
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
                            <div><p class="text-primary"></p></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-lg-4 col-md-6 pb-4">
        <div class="content-card">
            <div class="content-card-top">
                <div class="content-card-header">
                    <x-icon key="lightning-fill" mr="1" />
                    <span>{{ __('mbo.objectives.users.inprogress') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-objective-users-list :userAssignments="$objective->user_assignments" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6 pb-4">
        <div class="content-card">
            <div class="content-card-top">
                <div class="content-card-header">
                    <x-icon key="check2-square" mr="1" />
                    <span>{{ __('mbo.objectives.users.completed') }}</span>
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
@push('scripts')
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
@endpush
