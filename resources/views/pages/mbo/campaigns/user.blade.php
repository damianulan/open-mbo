@extends('layouts.portal.master')
@section('content')

<div class="icon-btn-nav">
    <div class="panel-left">
    </div>
</div>
<div class="content-card page-card">
    <div class="content-card-body">
        @include('components.mbo.campaign-summary')
        <div class="row">
            <div class="col-lg-6 col-md-12 pt-3">
                <h4>{{ __('globals.summary') }}</h4>
                <div>
                    {!! $chartCompletion->container() !!}
                </div>
            </div>
            <div class="col-lg-6 col-md-12 pt-3">
                <h4>{{ __('mbo.objectives.index') }}</h4>
                <x-objectives-list :model="$campaign" :user="$user" />
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
{!! $chartCompletion->script() !!}
<script type="text/javascript">
    var campaign_id = '{{ $campaign->id }}';

</script>
@endpush
