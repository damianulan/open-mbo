
<a class="card card-url card-bg" href="{{ $userCampaign && $userCampaign->exists ? route('campaigns.users.show', $userCampaign->id) : route('campaigns.show', $campaign->id) }}">
    <div class="card-body">
        <div class="card-top">
            <div class="card-title" data-tippy-content="{{ $campaign->name }}">
                {{ $campaign->name }}
            </div>
            <div class="card-badges">
                <div></div>
                @if($campaign->draft)
                    <div data-tippy-content="{{ __('globals.draft') }}">
                        <span class="badge bg-secondary">Draft</span>
                    </div>
                @endif
                @if($campaign->inProgress())
                    <div data-tippy-content="{{ __('forms.campaigns.stages.in_progress') }}">
                        <i class="bi bi-lightning-fill"></i>
                    </div>
                @endif
                @if($campaign->manual)
                    <div data-tippy-content="{{ __('globals.manual') }}">
                        <i class="bi bi-hand-index-thumb-fill"></i>
                    </div>
                @endif
                @if($campaign->terminated())
                    <div data-tippy-content="{{ __('forms.campaigns.stages.terminated') }}">
                        <i class="bi bi-pause-fill"></i>
                    </div>
                @endif
                @if($campaign->canceled())
                    <div data-tippy-content="{{ __('forms.campaigns.stages.canceled') }}">
                        <i class="bi bi-x-circle"></i>
                    </div>
                @endif
                <div data-tippy-content="{{ __('forms.campaigns.period') }}">
                    <span class="badge bg-secondary">{{ $campaign->period }}</span>
                </div>
            </div>
        </div>
        <div class="card-text">
            {{ strip_tags($campaign->description) }}
        </div>
        <div class="d-flex gap-3 details">
            <div class="">
                <div class="element">
                    <div class="element-title" data-tippy-content="{{ __('forms.campaigns.date_start') }}">
                        <i class="bi bi bi-calendar-check me-2"></i>
                        <span>{{ $campaign->dateStartView() }}</span>
                    </div>
                </div>
                <div class="element">
                    <div class="element-title" data-tippy-content="{{ __('forms.campaigns.date_end') }}">
                        <i class="bi bi-calendar-x me-2"></i>
                        <span>{{ $campaign->dateEndView() }}</span>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="element">
                    <div class="element-title" data-tippy-content="{{ __('mbo.num_participants') }}">
                        <i class="bi bi-people-fill me-2"></i>
                        <span>{{ $campaign->user_campaigns()->count() }}</span>
                    </div>
                </div>
                <div class="element">
                    <div class="element-title" data-tippy-content="{{ __('mbo.general_objectives') }}">
                        <i class="bi bi-crosshair me-2"></i>
                        <span>{{ $campaign->objectives()->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="">

            </div>
        </div>
    </div>
    @php
        $progress = $campaign->getProgress();
    @endphp
    @if ($progress)
        <x-card-progressbar :progress="$progress" :failed="false"/>
    @endif
</a>
