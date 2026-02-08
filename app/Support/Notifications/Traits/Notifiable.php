<?php

namespace App\Support\Notifications\Traits;

use App\Support\Notifications\Exceptions\NotificationNotFound;
use App\Support\Notifications\Models\MailNotification;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\Models\SystemNotification;
use App\Support\Notifications\NotificationMessage;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Throwable;

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

    public function notify(Notification|string $notification, array $datas = []): bool
    {
        try {
            if ( ! ($notification instanceof Notification) && is_string($notification)) {
                $notification = Notification::byKey($notification);
            }

            if ( ! $notification || ! ($notification instanceof Notification)) {
                throw new NotificationNotFound($notification);
            }

            return (new NotificationMessage($notification, $this, $datas))->send();
        } catch (Throwable $th) {
            report($th);
            if (config('app.debug')) {
                throw $th;
            }
        }

        return false;
    }
}
