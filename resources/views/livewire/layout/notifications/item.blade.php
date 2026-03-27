<li class="notification-li" wire:poll.30000ms>
    <a class="dropdown-item notification-item{{ $notification->unread() ? ' unread':'' }}" href="{{ route('notifications.index', ['notification' => $notification->id]) }}">
        <div class="notification-contents">
            @if($message)
                <div class="notification-text px-1">
                    {!! $message !!}
                </div>
            @endif

        </div>
        <div class="notification-time px-1 d-flex">
            <div class="ms-auto" data-tippy-content="{{ $notification->created_at->format(config('app.datetime_format')) }}">{{ $notification->created_at->diffForHumans() }}</div>
        </div>
    </a>
</li>
