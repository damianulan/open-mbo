<?php

namespace App\Support\Notifications\Jobs;

use App\Support\Notifications\Contracts\NotifiableEvent;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\Traits\Notifiable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;

class NotifyOnEvent implements ShouldQueueAfterCommit
{
    use InteractsWithQueue, Queueable;

    public function handle(NotifiableEvent $event)
    {
        $eventClass = $event::class;
        $notifications = Notification::whereEvent($eventClass)->get();
        $notifiable = $event->notifiable();
        $models = $this->getEventProperties($event);

        if (class_uses_trait(Notifiable::class, $notifiable::class)) {
            foreach ($notifications as $notification) {
                $notifiable->notify($notification, $models);
            }
        }
    }

    private function getEventProperties(NotifiableEvent $event): array
    {
        $reflection = new \ReflectionClass($event);

        $models = [];

        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($event);

            if ($value instanceof Model) {
                $models[] = $value;
            }
        }

        return $models;
    }
}
