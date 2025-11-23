<?php

namespace App\Support\Notifications\Traits;

use App\Support\Notifications\Models\MailNotification;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\Models\SystemNotification;
use App\Support\Notifications\NotificationMessage;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Notifiable
{
    public function system_notifications(): MorphMany
    {
        return $this->morphMany(SystemNotification::class, 'notifiable');
    }

    public function email_notifications(): MorphMany
    {
        return $this->morphMany(MailNotification::class, 'notifiable');
    }

    public function notify(Notification $notification, array $models = []): bool
    {
        return (new NotificationMessage($notification, $this, $models))->send();
    }
}
