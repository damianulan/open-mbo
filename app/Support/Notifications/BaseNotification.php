<?php

namespace App\Support\Notifications;

use App\Support\Notifications\Contracts\IsAppNotification;
use Illuminate\Notifications\Notification;

abstract class BaseNotification extends Notification
{
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    final public function via(object $notifiable): array
    {
        $params = [];
        $type = $this->type ?? null;
        $typeCondition = true;
        if ($type === 'system') {
            $typeCondition = $notifiable->preferences->system_notifications ?? false;
        }

        if ($typeCondition) {
            $mail = $notifiable->preferences->mail_notifications ?? 0;
            $database = $notifiable->preferences->app_notifications ?? 0;
            if ($mail && method_exists($this, 'toMail') && is_callable([$this, 'toMail'])) {
                $params[] = 'mail';
            }
            if ($database && $this instanceof IsAppNotification) {
                $params[] = 'database';
            }
        }

        return $params;
    }

    final public function toArray(object $notifiable): array
    {
        return $this instanceof IsAppNotification ? $this->toApp($notifiable)->toArray() : [];
    }
}
