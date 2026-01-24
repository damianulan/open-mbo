<?php

namespace App\Support\Notifications\Jobs;

use App\Support\Notifications\Contracts\NotifiableEvent;
use App\Support\Notifications\Factories\ResourceFactory;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\Traits\Notifiable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NotifyOnEvent implements ShouldQueue
{
    use Queueable;

    public $maxExceptions = 3;

    public function handle(NotifiableEvent $event): void
    {
        if ($event->checkConditions()) {
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

    public function withDelay(NotifiableEvent $event): int
    {
        return $event->notificationDelay() ?? 0;
    }
}
