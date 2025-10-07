<?php

namespace App\Support\Notifications\Jobs;

use App\Support\Notifications\Contracts\NotifiableEvent;
use App\Support\Notifications\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;

class NotifyOnEvent implements ShouldQueueAfterCommit
{
    use InteractsWithQueue;

    public function handle(NotifiableEvent $event)
    {
        $eventClass = $event::class;
        $notifications = Notification::whereEvent($eventClass)->get();
    }
}
