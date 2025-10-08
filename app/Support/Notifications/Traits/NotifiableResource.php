<?php

namespace App\Support\Notifications\Traits;

use App\Support\Notifications\Contracts\NotificationResource;
use App\Support\Notifications\Exceptions\ModelResourceNotFound;

trait NotifiableResource
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
}
