<?php

namespace App\Support\Notifications\Contracts;

use App\Support\Notifications\AppNotification;

interface IsAppNotification
{
    /**
     * Sends the notification to application's notifications dock.
     */
    public function toApp(object $notifiable): AppNotification;
}
