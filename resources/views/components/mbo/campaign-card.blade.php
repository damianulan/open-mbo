
<div class="card card-url card-bg" data-url="{{ route('campaigns.show', $campaign->id) }}">
    <div class="card-body">
        <div class="card-top">
            <div class="card-title" data-tippy-content="Kampania xxx">
                {{ $campaign->name }}
            </div>
            <div class="card-badges">
                <div></div>
                @if($campaign->draft)
                    <div data-tippy-content="Kopia robocza">
                        <span class="badge bg-secondary">Draft</span>
                    </div>
                @endif
                @if($campaign->inProgress())
                    <div data-tippy-content="Kampania w toku">
                        <i class="bi bi-lightning-fill"></i>
                    </div>
                @endif
                @if($campaign->manual)
                    <div data-tippy-content="Tryb ręczny">
                        <i class="bi bi-hand-index-thumb-fill"></i>
                    </div>
                @endif
                @if($campaign->terminated())
                    <div data-tippy-content="Kampania zawieszona">
                        <i class="bi bi-pause-fill"></i>
                    </div>
                @endif
                @if($campaign->canceled())
                    <div data-tippy-content="Kampania anulowana">
                        <i class="bi bi-x-circle"></i>
                    </div>
                @endif
                <div data-tippy-content="Okres pomiaru">
                    <span class="badge bg-secondary">{{ $campaign->period }}</span>
                </div>
            </div>
        </div>
        <div class="card-text">
            {{ $campaign->description->stripFormat() }}
        </div>
        <div class="row details">
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-tippy-content="Data startu pomiaru">
                        <i class="bi bi bi-calendar-check me-2"></i>
                        <span>{{ $campaign->dateStartView() }}</span>
                    </div>
                </div>
                <div class="element">
                    <div class="element-title" data-tippy-content="Data końca pomiaru">
                        <i class="bi bi-calendar-x me-2"></i>
                        <span>{{ $campaign->dateEndView() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-tippy-content="Ilość uczestników">
                        <i class="bi bi-people-fill me-2"></i>
                        <span>{{ $campaign->user_campaigns()->count() }}</span>
                    </div>
                </div>
                <div class="element">
                    <div class="element-title" data-tippy-content="Cele podstawowe">
                        <i class="bi bi-crosshair me-2"></i>
                        <span>{{ $campaign->objectives()->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">

            </div>
        </div>
    </div>
    @php
        $progress = $campaign->getProgress();
    @endphp
    @if ($progress)
        <x-card-progressbar :progress="$progress" :failed="false"/>
    @endif
</div>
