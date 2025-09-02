@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-right">
        @if(auth()->user()->id !== $user->id)
            <x-user-banner :user="$user" />
        @endif
    </div>
    <div class="panel-left">
        <a class="icon-btn edit-realization" href="javascript:void(0);" data-modelid="{{ $userObjective->id }}" data-tippy-content="{{ __('buttons.edit_realization') }}"><i class="bi-layer-forward"></i></a>
    </div>
</div>
<div class="row">

    <div class="col-xl-12">
        <x-objective-summary :objective="$objective" :userObjective="$userObjective" />
    </div>
    <div class="col-xl-12 col-xs-12">
        <div class="content-card">
            <div class="content-card-top">
                <div class="content-card-header">
                    <i class="bi-chat-left-quote me-2"></i>
                    <span>{{ __('Komentarze') }}</span>
                </div>
            </div>
            <div class="content-card-body">
                <livewire:commentable :subject="$userObjective" key="str()->random(50)" />
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $('.edit-realization').on('click', function() {
        var model_id = $(this).attr('data-modelid');

        if(model_id && model_id !== ''){
            $.getModal('App\\Http\\Controllers\\Objectives\\UserObjectiveController@editRealization', {id: model_id});
        }
    });

</script>
@endpush
