<?php

namespace App\Support\Notifications\Traits;

use App\Support\Notifications\Contracts\NotificationResource;
use App\Support\Notifications\Exceptions\ModelResourceNotFound;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\NotificationMessage;

trait Notifiable
{
    public function getNotificationResource(): NotificationResource
    {
        if (isset($this->notificationResource) && class_exists($this->notificationResource)) {
            $class = $this->notificationResource;
            $resource = new $class($this);
            if ($resource && $resource instanceof NotificationResource) {
                return $resource;
            }
        }

        throw new ModelResourceNotFound($this);
    }
    public function system_notifications()
    {
        //
    }

    public function notify(Notification $notification, array $models = []): bool
    {
        return (new NotificationMessage($notification, $this, $models))->send();
    }
}
