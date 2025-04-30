@if($userCampaigns->count())
    <ul class="ombo-list">
        @foreach ($userCampaigns as $uc)
            @php
            $user = $uc->user;
            @endphp
            @if($user)
                <li>
                    <div class="list-grid">
                        <div class="list-content">
                            <div class="nowrap user" data-tippy-content="{{ $user->name() }}">
                                {!! $user->nameDetails() !!}
                            </div>
                        </div>
                        <div class="list-actions">
                            <div class="list-action me-2" data-tippy-content="{{ $uc->stageDescription() }}">
                                <i class="{{ $uc->stageIcon() }}"></i>
                            </div>
                            <a href="" class="list-action me-2" data-modelid="{{ $uc->id }}" data-tippy-content="{{ __('buttons.summary') }}">
                                <i class="bi-eye-fill"></i>
                            </a>
                            @if($uc->manual)
                                <a href="{{ route('campaigns.users.prev_stage', $uc->id) }}" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Przesuń do poprzedniego etapu">
                                    <i class="bi-caret-left-fill"></i>
                                </a>
                                <a href="{{ route('campaigns.users.next_stage', $uc->id) }}" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Przesuń do następnego etapu">
                                    <i class="bi-caret-right-fill"></i>
                                </a>
                                <a href="{{ route('campaigns.users.toggle_manual', $uc->id) }}" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Wyłącz tryb ręczny">
                                    <i class="bi-hand-index-thumb-fill"></i>
                                </a>
                            @else
                                <a href="{{ route('campaigns.users.toggle_manual', $uc->id) }}" class="list-action me-2" data-ucid="{{ $uc->id }}" data-tippy-content="Włącz tryb ręczny">
                                    <i class="bi-hand-index-thumb"></i>
                                </a>
                            @endif
                            <a class="user-delete" href="javascript:void(0);" class="list-action" data-url="{{ route('campaigns.users.delete', $uc->id) }}">
                                <i class="bi-x-lg"></i>
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
