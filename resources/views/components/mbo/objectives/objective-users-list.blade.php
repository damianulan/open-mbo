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
                            <div class="nowrap user" data-tippy-content="{{ $user->name }}">
                                {!! $user->nameDetails() !!}
                            </div>
                        </div>
                        <div class="list-actions">
                            <div class="list-action tippy-info" data-tippy-content="{{ $ua->getStatusLabel() }}"><x-icon key="circle-fill" classes="text-{{ $ua->status }}" /></div>
                            <a href="{{ route('objectives.assignment.show', $ua->id) }}" class="list-action" data-tippy-content="{{ __('buttons.summary') }}">
                                <x-icon key="eye-fill" />
                            </a>
                            @if($ua->campaign)
                                <a href="{{ route('campaigns.show', $ua->campaign->id) }}" class="list-action" data-tippy-content="{{ $ua->campaign->name }}">
                                    <x-icon key="bullseye" />
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
@else
    <div><p class="text-primary pt-3">{{ $emptyInfo }}</p></div>
@endif
