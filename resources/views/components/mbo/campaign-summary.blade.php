<div>
    @php
        $coordinators = $campaign->coordinators;
    @endphp
    <div class="row">
        <div class="col-md-12">
            {!! $campaign->description !!}
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-8 col-sm-12 pt-3">
            <table>
                @php
                    $campaign->setStageAuto();
                    $currentStages = $campaign->getCurrentStages();
                @endphp
                @foreach($campaign->getSoftStages() as $stage)
                    @php
                        $start_prop = $stage . '_from';
                        $end_prop = $stage . '_to';
                        $current = $currentStages->contains($stage);
                    @endphp
                    <tr class="{{ $current ? 'text-success':'text-primary' }} fw-bold p-1" data-tippy-content="{{ $campaign->getStageInfo($stage) }}">
                        <td class="px-1 align-content-center">
                            <i class="{{ $campaign->getStageIcon($stage) }} fs-5"></i>
                        </td>
                        <td class="px-1 align-content-baseline">
                            {{ $campaign->$start_prop?->format('Y-m-d') }} - {{ $campaign->$end_prop?->format('Y-m-d') }}
                        </td>
                        <td class="px-1 align-content-baseline">
                            {{ $campaign->getStageName($stage) }}
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="col-xl-6 col-lg-4 col-sm-12 pt-3">
            <div class="float-end fs-6">
                <div class="d-flex text-primary align-items-center">
                    <i class="bi-person-fill-gear fs-4 me-2"></i>
                    <div class="fw-bold">{{ __('mbo.campaign_coordinators') }}:</div>
                </div>
                @if($coordinators->isNotEmpty())
                    <ul class="list-style-none">
                        @foreach($coordinators as $coordinator)
                            <li class="user">{!! $coordinator->nameDetails() !!}</li>
                        @endforeach

                    </ul>
                @else
                    <div class="text-primary">{{ __('mbo.info.no_c_coordinators_added') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>
