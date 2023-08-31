
<div class="card card-url card-bg" data-url="{{ route('campaigns.show', $objective->id) }}">
    <div class="card-body">
        <div class="card-top">
            <div class="card-title" data-bs-toggle="tooltip" data-bs-title="Kampania xxx">
                {{ $objective->name }}
            </div>
            <div class="card-badges">
                <div></div>
                @if($objective->draft)
                    <div data-bs-toggle="tooltip" data-bs-title="Kopia robocza">
                        <span class="badge bg-secondary">Draft</span>
                    </div>
                @endif
                @if($objective->category())
                <div data-bs-toggle="tooltip" data-bs-title="Kategoria">
                    <span class="badge bg-secondary">{{ $objective->category()->anme }}</span>
                </div>
                @endif
            </div>
        </div>
        <div class="card-text">
            {{ $objective->description->stripFormat() }}
        </div>
        <div class="row details">
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Termin realizacji">
                        <i class="bi bi bi-calendar2-date me-2"></i>
                        <span>{{ $objective->deadline }}</span>
                    </div>
                </div>
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Data końca pomiaru">
                        <i class="bi bi-heart-arrow me-2"></i>
                        <span>{{ $objective->goal }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Ilość uczestników">
                        <i class="bi bi-people-fill me-2"></i>
                        <span>{{ $objective->user_campaigns()->count() }}</span>
                    </div>
                </div>
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Cele podstawowe">
                        <i class="bi bi-bullseye me-2"></i>
                        <span>{{ $objective->objective_templates()->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-bs-toggle="tooltip" data-bs-title="Autor kampanii">
                        <i class="bi bi-person-fill me-2"></i>
                        <span></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
