<?php

namespace App\Support\Notifications\Jobs;

use App\Support\Notifications\Factories\ResourceFactory;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\Traits\Notifiable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;

class NotifyOnEvent implements ShouldQueueAfterCommit
{
    use InteractsWithQueue, Queueable;

    public function handle($event)
    {
        $eventClass = $event::class;
        $notifications = Notification::whereEvent($eventClass)->get();
        $notifiable = $event->notifiable();
        $models = ResourceFactory::getEventResourceModels($event);

        if (class_uses_trait(Notifiable::class, $notifiable::class)) {
            foreach ($notifications as $notification) {
                $notifiable->notify($notification, $models);
            }
        }
    }
}
