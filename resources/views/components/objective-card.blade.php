
<div class="card card-url card-bg" data-url="{{ route('management.objectives.edit', $objective->id) }}">
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
                    <span class="badge bg-secondary">{{ $objective->category->name }}</span>
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
                        <span>{{ $objective->users_count() }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
