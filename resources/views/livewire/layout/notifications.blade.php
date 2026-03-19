<div class="notification-dropdown dropdown me-3" wire:poll.10000ms>
    <a class="dropdown-toggle @if($shown) show @endif" type="button" @if($shown) aria-expanded="true" @else aria-expanded="false" @endif
        data-bs-toggle="dropdown" data-tippy-placement="bottom" data-tippy-content="{{ __('globals.notifications') }}" wire:click="toggleShown">
        <i class="bi bi-bell-fill"></i>
        @if($this->unreadNotificationsCount)
            <span class="badge badge-circle badge-primary">{{ $this->unreadNotificationsCount }}</span>
        @endif
    </a>
    <ul class="dropdown-menu @if($shown) show @endif" @if($shown) style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 28px);" data-popper-placement="bottom-end" @endif>
        <li><div class="dropdown-header">{{ __('globals.notifications') }}</div></li>
        @if($this->notifications->isNotEmpty())
            @foreach ($this->notifications as $notification)
                @livewire('notification.item', ['notification' => $notification], key("notification-{$notification->id}"))
            @endforeach
        @else
            <li>
                <div class="dropdown-header" style="white-space: normal;"><strong>{{ __('notifications.info.empty') }}</strong></div>
            </li>
        @endif
        <li class="notification-li"><div class="dropdown-footer"><a href="{{ route('notifications.index') }}" class="link-muted">{{ __('notifications.info.show_all') }}</a></div></li>
    </ul>
</div>
@push('custom-scripts')
    <script type="text/javascript">
        document.addEventListener('livewire:init', () => {
            Livewire.on('new-notification', (event) => {
                $.notify(event.title, 'info');
            });
        });
    </script>
@endpush
