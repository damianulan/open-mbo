
<div class="card failed card-url card-bg" data-url="{{ route('campaigns.show', $campaign->id) }}">
    <div class="card-body">
        <div class="card-top">
            <div class="card-title" data-bs-toggle="tooltip" data-bs-title="Kampania xxx">
                {{ $campaign->name }}
            </div>
            <div class="card-badges">
                <div></div>
                @if($campaign->draft)
                    <div data-bs-toggle="tooltip" data-bs-title="Kopia robocza">
                        <span class="badge bg-secondary">Draft</span>
                    </div>
                @endif
                @if($campaign->active())
                    <div data-bs-toggle="tooltip" data-bs-title="Kampania w toku">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                @endif
                @if($campaign->manual)
                    <div data-bs-toggle="tooltip" data-bs-title="Tryb ręczny">
                        <i class="bi bi-hand-index-thumb-fill"></i>
                    </div>
                @endif
                <div data-bs-toggle="tooltip" data-bs-title="Okres pomiaru">
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
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Data startu pomiaru">
                        <i class="bi bi bi-calendar-check me-2"></i>
                        <span>{{ $campaign->dateStart() }}</span>
                    </div>
                </div>
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Data końca pomiaru">
                        <i class="bi bi-calendar-x me-2"></i>
                        <span>{{ $campaign->dateEnd() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Ilość uczestników">
                        <i class="bi bi-people-fill me-2"></i>
                        <span>{{ $campaign->user_campaigns()->count() }}</span>
                    </div>
                </div>
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Cele podstawowe">
                        <i class="bi bi-bullseye me-2"></i>
                        <span>{{ $campaign->objective_templates()->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Autor kampanii">
                        <i class="bi bi-person-fill me-2"></i>
                        <span>{{ $campaign->creator->name() }}</span>
                    </div>
                </div>

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
