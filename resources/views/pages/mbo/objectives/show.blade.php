@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-left">
        <a class="icon-btn edit-objective" href="javascript:void(0);" data-modelid="{{ $objective->id }}" data-tippy-content="{{ __('buttons.edit') }}"><i class="bi-pencil-fill"></i></a>
    </div>
</div>
<div class="row">
    <div class="@if($objective->coordinators())col-xl-8 col-lg-9 col-md-12 @else col-xl-12 col-lg-12 col-md-12 @endif pb-4">
        <x-objective-summary :objective="$objective" />
    </div>
    @if($objective->coordinators())
        <div class="col-xl-4 col-lg-3 col-md-12 pb-4">
            <div class="content-card">
                <div class="content-card-top">
                    <div class="content-card-header">
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
                                                <div class="nowrap user" data-tippy-content="{{ $user->name }}">
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
                    <x-objective-users-list :objective="$objective" :status="'progress'" />
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
                <div class="col-md-6">
                    <x-objective-users-list :objective="$objective" :status="'passed'" />
                </div>
                <div class="col-md-6">
                    <x-objective-users-list :objective="$objective" :status="'failed'"  />
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
