<div class="row">
    <div class="col-12">
        @foreach($userCampaigns as $uc)
            @php
                $chart = $uc->chart('user_campaign_evaluation');
            @endphp
            <div class="row pt-2">
                <div class="col-xl-4">
                    <div><x-campaign-card :campaign="$uc->campaign" :userCampaign="$uc" /></div>
                    <div class="py-2"><span>{{ __('fields.stage') }}:</span> <span class="text-highlight">{{ $uc->stage->label() }}</span></div>
                    <div>{!! $chart->container() !!}</div>
                </div>
                <div class="col-xl-8">
                    <div><x-objectives-list :model="$uc->campaign" :user="$user" /></div>
                </div>
            </div>
            @push('scripts')
                {!! $chart->script() !!}
            @endpush
        @endforeach
    </div>
</div>
