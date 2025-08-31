@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-right">
        @if(auth()->user()->id !== $user->id)
            <x-user-banner :user="$user" />
        @endif
    </div>
    <div class="panel-left">
        <a class="icon-btn add-realization" href="javascript:void(0);" data-modelid="" data-tippy-content="{{ __('buttons.add_realization') }}"><i class="bi-layer-forward"></i></a>
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
            $.getModal('App\\Http\\Controllers\\Campaigns\\CampaignObjectiveController@addObjectives', {id: model_id});
        }
    });

</script>
@endpush
