@if($objectives->count())
    <ul class="ombo-list">
        @foreach ($objectives as $objective)
            <li class="{{ $userObjective && $objective->isDeadlineUpcoming() ? 'warning' : '' }}">
                <div class="list-grid">
                    <div class="list-content">
                        <div class="nowrap" data-tippy-content="{{ $objective->name }}">
                            <i class="bi text-primary {{ $objective->campaign_id ? 'bi-bullseye':'bi-crosshair' }} me-1"></i>
                            <span>{{ $objective->name }}</span>
                        </div>

                    </div>
                    <div class="list-actions">
                        @if($objective->draft)
                        <div class="list-action" data-tippy-content="{{ __('forms.mbo.objectives.info.draft') }}">
                            <x-icon key="feather" />
                        </div>
                        @endif
                        <div class="list-action" data-tippy-content="{{ __('forms.mbo.objectives.weight') }}: {{ $objective->weight }}">
                            <x-icon key="minecart-loaded" />
                            <span>{{ $objective->weight }}</span>
                        </div>
                        @if($objective->expected)
                        <div class="list-action" data-tippy-content="{{ __('forms.mbo.objectives.expected') }}: {{ $objective->expected }}">
                            <x-icon key="patch-check" />
                            <span>{{ $objective->expected }}</span>
                        </div>
                        @endif
                        @if($objective->isOverdued())
                            <a class="list-action text-warning" data-tippy-content="{{ __('alerts.objectives.error.overdued', ['term' => $objective->deadline->diffForHumans()]) }}">
                                <x-icon key="exclamation-diamond-fill" />
                            </a>
                        @else
                            <a class="list-action" data-tippy-content="{{ __('forms.mbo.objectives.deadline_to', ['term' => $objective->deadline->format(config('app.datetime_format'))]) }}">
                                <x-icon key="calendar2-week-fill" />
                            </a>
                        @endif
                        <a href="{{ $userObjective ? route('objectives.assignment.show', $userObjective->id):route('objectives.show', $objective->id) }}" class="list-action" data-modelid="{{ $objective->id }}" data-tippy-content="{{ __('buttons.summary') }}">
                            <x-icon key="eye-fill" />
                        </a>
                        <a href="javascript:void(0);" class="list-action edit-objective" data-modelid="{{ $objective->id }}" data-tippy-content="{{ __('buttons.edit') }}">
                            <x-icon key="pencil-fill" />
                        </a>
                        @if(!$user->exists || $user->id !== auth()->user()->id)
                            <a href="javascript:void(0);" data-url="{{ route('campaigns.objective.delete', $objective->id) }}" class="list-action delete-objective" data-tippy-content="{{ __('buttons.delete') }}">
                                <x-icon key="x-lg" />
                            </a>
                        @endif
                    </div>
                </div>
            </li>

        @endforeach
    </ul>
@else
    <div><p class="text-primary">{{ __('mbo.info.no_objectives_added') }}</p></div>
@endif
