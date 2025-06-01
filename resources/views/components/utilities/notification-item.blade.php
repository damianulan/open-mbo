<li class="notification-li">
    <a class="dropdown-item notification-item{{ $notification->unread() ? ' unread':'' }}" href="{{$notification->data['link'] ?? 'javascript:void(0);'}}">
        <div class="notification-contents">
            @if(isset($notification->data['icon']))
                <div class="notification-icon px-1">
                    <i class="{{ $notification->data['icon'] }}"></i>
                </div>
            @endif
            @if($message)
                <div class="notification-text px-1">
                    {!! $message !!}
                </div>
            @endif

        </div>
        <div class="notification-time px-1 text-end">
            {{ $notification->created_at->diffForHumans() }}
        </div>
    </a>
</li>
