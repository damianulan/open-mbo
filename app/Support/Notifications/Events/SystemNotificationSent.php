<?php

namespace App\Support\Notifications\Events;

use App\Support\Notifications\Models\SystemNotification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SystemNotificationSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public SystemNotification $notification) {}
}
