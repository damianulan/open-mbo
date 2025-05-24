@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-right">
        <x-user-banner :user="$user" />
    </div>
    <div class="panel-left">
        <a class="icon-btn edit-objective" href="javascript:void(0);" data-modelid="" data-tippy-content="{{ __('buttons.edit') }}"><i class="bi-pencil-fill"></i></a>
    </div>
</div>
<div class="row">

    <div class="col-xl-12 pb-4">
        <x-objective-summary :objective="$objective" :userObjective="$userObjective" />
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
