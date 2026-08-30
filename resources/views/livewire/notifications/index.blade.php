<div class="row g-3">
    <div class="col-12 col-xl-5">
        <div class="content-card h-100">
            <div class="content-card-header">
                {{ __('globals.notifications') }}
            </div>

            @if($notifications->isEmpty())
                <div class="p-3">
                    <strong>{{ __('notifications.info.empty') }}</strong>
                </div>
            @else
                <div class="list-group list-group-flush">
                    @foreach($notifications as $notification)
                        <button
                            class="list-group-item list-group-item-action text-start{{ $selectedNotification?->id === $notification->id ? ' active' : '' }}{{ $notification->unread() ? ' unread' : '' }}"
                            type="button"
                            wire:click="showNotification('{{ $notification->id }}')"
                            wire:key="notification-list-{{ $notification->id }}"
                        >
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <div class="small fw-semibold">
                                    {{ $notification->created_at?->diffForHumans() }}
                                </div>
                                @if($notification->unread())
                                    <span class="badge badge-primary">{{ __('notifications.info.new') }}</span>
                                @endif
                            </div>
                            <div class="mt-2">
                                {{ $notification->preview() }}
                            </div>
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="col-12 col-xl-7">
        <div class="content-card h-100">
            <div class="content-card-header">
                {{ __('notifications.info.preview') }}
            </div>

            @if($selectedNotification)
                <div class="p-3">
                    <div class="text-muted small mb-3">
                        {{ $selectedNotification->created_at?->format(config('app.datetime_format')) }}
                    </div>

                    <div class="notification-preview-body">
                        {!! $selectedNotification->renderedContents() !!}
                    </div>
                </div>
            @else
                <div class="p-3 text-muted">
                    {{ __('notifications.info.preview_empty') }}
                </div>
            @endif
        </div>
    </div>
</div>
