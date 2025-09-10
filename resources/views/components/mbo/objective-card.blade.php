
<div class="card card-url card-bg" data-url="{{ route('templates.edit', $objective->id) }}">
    <div class="card-body">
        <div class="card-top">
            <div class="card-title" data-tippy-content="{{ $objective->name }}">
                {{ $objective->name }}
            </div>
            <div class="card-badges">
                <div></div>
                @if($objective->draft)
                    <div data-tippy-content="Kopia robocza">
                        <span class="badge bg-warning">{{ __('Draft') }}</span>
                    </div>
                @endif
                @if($objective->category)
                <div class="align-self-center" data-tippy-content="{{ __('fields.category') }}">
                    <span class="badge bg-secondary">{{ $objective->category->name }}</span>
                </div>
                @endif
            </div>
        </div>
        <div class="card-text">
            {{ strip_tags($objective->description) }}
        </div>
        <div class="row details">
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-tippy-content="{{ __('mbo.linked_to_campaigns') }}">
                        <i class="bi bi-bullseye me-2"></i>
                        <span>{{ $objective->campaignsCount() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="element">
                    <div class="element-title" data-tippy-content="{{ __('mbo.num_participants') }}">
                        <i class="bi bi-people-fill me-2"></i>
                        <span>{{ $objective->usersCount() }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
