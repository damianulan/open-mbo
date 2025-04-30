@if($objectives->count())
    <ul class="ombo-list">
        @foreach ($objectives as $objective)
        <li>
            <div class="list-grid">
                <div class="list-content">
                    <div class="nowrap" data-tippy-content="{{ $objective->name }}">
                        <i class="bi text-primary bi-crosshair me-1"></i>
                        <span>{{ $objective->name }}</span>
                    </div>

                </div>
                <div class="list-actions">
                    @if($objective->draft)
                    <div class="list-action me-3" data-tippy-content="{{ __('forms.mbo.objectives.info.draft') }}">
                        <x-icon key="feather" />
                    </div>
                    @endif
                    <div class="list-action me-3" data-tippy-content="Waga celu">
                        <x-icon key="minecart-loaded" />
                        <span>{{ $objective->weight }}</span>
                    </div>
                    @if($objective->expected)
                    <div class="list-action me-3" data-tippy-content="{{ __('forms.mbo.objectives.expected') }}">
                        <x-icon key="patch-check" />
                        <span>{{ $objective->expected }}</span>
                    </div>
                    @endif
                    <a href="{{ route('objectives.show', $objective->id) }}" class="list-action" data-modelid="{{ $objective->id }}" data-tippy-content="{{ __('buttons.summary') }}">
                        <x-icon key="eye-fill" />
                    </a>
                    <a href="javascript:void(0);" class="list-action edit-objective" data-modelid="{{ $objective->id }}" data-tippy-content="{{ __('buttons.edit') }}">
                        <x-icon key="pencil-fill" />
                    </a>
                    <a href="javascript:void(0);" data-url="{{ route('campaigns.objective.delete', $objective->id) }}" class="list-action delete-objective" data-tippy-content="{{ __('buttons.delete') }}">
                        <x-icon key="x-fill" />
                    </a>
                </div>
            </div>
        </li>

        @endforeach
    </ul>
@else
    <div><p class="text-primary">{{ __('mbo.info.no_objectives_added') }}</p></div>
@endif
