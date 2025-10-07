<?php

namespace App\Support\Notifications\Contracts;

interface HasNotificationResource
{
    public function notificationResource(): NotificationResource;
}
