<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\DatabaseNotification;

class NotificationDropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $notifications_count = Auth::user()->unreadNotifications()->count();
        $notifications = Auth::user()->notifications()->take(10)->get();

        return view('components.notification-dropdown', [
            'notifications' => $notifications,
            'notifications_count' => $notifications_count,
        ]);
    }
}
