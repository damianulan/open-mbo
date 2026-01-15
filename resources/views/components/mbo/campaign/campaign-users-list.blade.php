@if($userCampaigns->count())
    <ul class="ombo-list">
        @foreach ($userCampaigns as $uc)
            @php
            $user = $uc->user;
            @endphp
            @if($user)
                <li class="{{ $user->blocked() ? 'inactive':'' }}">
                    <div class="list-grid">
                        <div class="list-content">
                            <div class="nowrap user" data-tippy-content="{{ $user->name }}">
                                {!! $user->nameDetails() !!}
                            </div>
                        </div>
                        <div class="list-actions">
                            <div class="list-action" data-tippy-content="{{ $uc->stageDescription() }}">
                                <i class="{{ $uc->stageIcon() }}"></i>
                            </div>
                            <a href="" class="list-action" data-modelid="{{ $uc->id }}" data-tippy-content="{{ __('buttons.summary') }}">
                                <i class="bi-eye-fill"></i>
                            </a>
                            @can('manual', $uc->campaign)
                                @settings('mbo.campaigns_manual')
                                    @if($uc->isManual())
                                        @if(in_array($uc->stage, array_keys(\App\Enums\MBO\CampaignStage::sequences())))
                                            <a href="{{ route('campaigns.users.prev_stage', $uc->id) }}" class="list-action" data-ucid="{{ $uc->id }}" data-tippy-content="Przesuń do poprzedniego etapu">
                                                <i class="bi-caret-left-fill"></i>
                                            </a>
                                            <a href="{{ route('campaigns.users.next_stage', $uc->id) }}" class="list-action" data-ucid="{{ $uc->id }}" data-tippy-content="Przesuń do następnego etapu">
                                                <i class="bi-caret-right-fill"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('campaigns.users.toggle_manual', $uc->id) }}" class="list-action" data-ucid="{{ $uc->id }}" data-tippy-content="Wyłącz tryb ręczny">
                                            <i class="bi-hand-index-thumb-fill"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('campaigns.users.toggle_manual', $uc->id) }}" class="list-action" data-ucid="{{ $uc->id }}" data-tippy-content="Włącz tryb ręczny">
                                            <i class="bi-hand-index-thumb"></i>
                                        </a>
                                    @endif
                                @endsettings
                            @endcan

                            @can('users', $uc->campaign)
                                <a class="user-delete" href="javascript:void(0);" class="list-action" data-tippy-content="Wypisz użytkownika" data-url="{{ route('campaigns.users.delete', $uc->id) }}">
                                    <i class="bi-x-lg"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
@else
    <div><p class="text-primary">{{ __('mbo.info.no_users_added') }}</p></div>
@endif
