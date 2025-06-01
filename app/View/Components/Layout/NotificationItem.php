<?php

namespace App\View\Components\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Notifications\DatabaseNotification;

class NotificationItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public DatabaseNotification $notification)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $message = $this->notification->data['message'] ?? null;
        if ($message) {
            $message = strip_tags($message, '<strong><i>');
        }
        return view('components.utilities.notification-item', [
            'notification' => $this->notification,
            'message' => $message,
        ]);
    }
}
