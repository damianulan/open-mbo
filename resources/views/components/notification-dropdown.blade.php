<div class="notification-dropdown dropdown me-3">
    <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-tippy-placement="bottom" data-tippy-content="Powiadomienia">
        <i class="bi bi-bell-fill"></i>
        @if($notifications_count > 0)
            <span class="badge badge-circle badge-primary">{{ $notifications_count }}</span>
        @endif
    </a>
    <ul class="dropdown-menu">
        <li><div class="dropdown-header">{{ __('globals.notifications') }}</div></li>
        @if($notifications->isNotEmpty())
            @foreach ($notifications as $notification)
                <x-notification-item :notification="$notification"/>
            @endforeach
        @else
            <li>
                <div class="dropdown-header" style="white-space: normal;"><strong>{{ __('notifications.info.empty') }}</strong></div>
            </li>
        @endif
        <li class="notification-li"><div class="dropdown-footer"><a href="#" class="link-muted">{{ __('notifications.info.show_all') }}</a></div></li>
    </ul>
</div>
