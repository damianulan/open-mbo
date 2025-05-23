@if($userAssignments->count())
    <ul class="ombo-list">
        @foreach ($userAssignments as $ua)
            @php
                $user = $ua->user;
            @endphp

            @if($user)
                <li class="status-{{ $ua->status }}">
                    <div class="list-grid">
                        <div class="list-content">
                            <div class="nowrap user" data-tippy-content="{{ $user->name() }}">
                                {!! $user->nameDetails() !!}
                            </div>
                        </div>
                        <div class="list-actions">
                            <div class="list-action tippy-info" data-tippy-content="{{ __('mbo.objective_status.' . $ua->status) }}"><x-icon key="info-circle-fill" /></div>
                            <a href="{{ route('objectives.assignment.show', $ua->id) }}" class="list-action" data-tippy-content="{{ __('buttons.summary') }}">
                                <x-icon key="eye-fill" />
                            </a>
                        </div>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
@else
    <div><p class="text-primary">{{ __('mbo.info.no_users_added') }}</p></div>
@endif
