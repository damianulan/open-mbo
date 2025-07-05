<?php

namespace App\Support\Notifications;

use Illuminate\Notifications\Notification;

class BaseNotification extends Notification
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
            if ($database && method_exists($this, 'toArray') && is_callable([$this, 'toArray'])) {
                $params[] = 'database';
            }
        }

        return $params;
    }
}
