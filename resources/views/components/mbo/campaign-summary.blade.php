<div class="row">
    <div class="col-md-12">
        {!! $campaign->description->get() !!}
    </div>
</div>
<div class="row my-2">
    <div class="col-md-6">
        @php
        $campaign->setStageAuto();
        $currentStages = $campaign->getCurrentStages();
        @endphp
        @foreach($campaign->getSoftStages() as $stage)
            @php
                $start_prop = $stage . '_from';
                $end_prop = $stage . '_to';
                $current = false;
                if(in_array($stage, $currentStages->toArray())){
                    $current = true;
                }
            @endphp
            <div class="d-flex {{ $current ? 'text-success':'text-primary' }} align-items-center">
                <div class="me-2" data-tippy-content=" {{ $campaign->getStageInfo($stage) }}"">
                    <i class="{{ $campaign->getStageIcon($stage) }} fs-5"></i>
                </div>
                <div class="fw-bold me-2">{{ $campaign->carbonDate($start_prop) }} - {{ $campaign->carbonDate($end_prop) }}</div>
                <div class="fw-bold me-2">{{ $campaign->getStageName($stage) }}</div>
            </div>

        @endforeach

    </div>
    <div class="col-md-6">
        <div class="float-end fs-6">
            <div class="d-flex text-primary align-items-center">
                <i class="bi-person-fill-gear fs-4 me-2"></i>
                <div class="fw-bold">Koordynatorzy Kampanii:</div>
            </div>
            <ul>
                @foreach($campaign->coordinators as $coordinator)
                    <li>{!! $coordinator->nameView() !!}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
