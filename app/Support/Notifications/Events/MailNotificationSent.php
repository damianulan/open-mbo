<?php

namespace App\Support\Notifications\Events;

use App\Support\Notifications\Models\MailNotification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MailNotificationSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct(public MailNotification $notification) {}
}
