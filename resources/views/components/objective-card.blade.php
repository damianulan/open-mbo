
<div class="card card-url card-bg" data-url="{{ route('management.objectives.edit', $objective->id) }}">
    <div class="card-body">
        <div class="card-top">
            <div class="card-title" data-tippy-content="Kampania xxx">
                {{ $objective->name }}
            </div>
            <div class="card-badges">
                <div></div>
                @if($objective->draft)
                    <div data-tippy-content="Kopia robocza">
                        <span class="badge bg-warning">Draft</span>
                    </div>
                @endif
                @if($objective->category())
                <div data-tippy-content="Kategoria">
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
                    <div class="element-title" data-tippy-content="Powiązano z kampaniami">
                        <i class="bi bi-bullseye me-2"></i>
                        <span>{{ $objective->campaignsCount() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-tippy-content="Ilość uczestników">
                        <i class="bi bi-people-fill me-2"></i>
                        <span>{{ $objective->usersCount() }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
