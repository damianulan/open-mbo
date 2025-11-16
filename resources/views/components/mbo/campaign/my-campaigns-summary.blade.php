<div class="row">
    @foreach($userCampaigns as $uc)
        <div class="pt-2 col-12">
            <div class="d-flex gap-2">
                <div class="col-xl-3">
                    <div><x-campaign-card :campaign="$uc->campaign" /></div>
                    <div class="py-2"><span>{{ __('fields.stage') }}:</span> <span class="text-highlight">{{ $uc->stage->label() }}</span></div>
                </div>
                <div><x-objectives-list :model="$uc->campaign" :user="$user" /></div>

            </div>

        </div>
    @endforeach
</div>
