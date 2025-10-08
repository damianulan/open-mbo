<?php

namespace App\Support\Notifications\Jobs;

use App\Support\Notifications\Contracts\NotifiableEvent;
use App\Support\Notifications\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;
use App\Support\Notifications\Traits\Notifiable;
use Illuminate\Database\Eloquent\Model;

class NotifyOnEvent implements ShouldQueueAfterCommit
{
    use InteractsWithQueue;

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

    private function getEventProperties(NotifiableEvent $object): array
    {
        $reflection = new \ReflectionClass($object);

        $models = [];

        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($object);

            if ($value instanceof Model) {
                $models[] = $value;
            }
        }

        return $models;
    }
}
