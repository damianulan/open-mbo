<?php

namespace App\View\Components\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

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
        $notifications_count = Auth::user()->notifications()->unread()->where('data', '!=', '[]')->count();
        $notifications = Auth::user()->notifications()->where('data', '!=', '[]')->take(10)->get();

        return view('components.notification-dropdown', [
            'notifications' => $notifications,
            'notifications_count' => $notifications_count,
        ]);
    }
}
