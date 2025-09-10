<?php

namespace App\Listeners\Activity;

use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Log;

class NotificationLog
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NotificationSent $event): void
    {
        $user = $event->notifiable;
        $notification = $event->notification;

        Log::info('notification sent', ['user' => $user, 'notification' => $notification]);

        // TODO - check and store wether it was database or mail notification.

        // if($user && $notification){
        //     activity('notification')
        //     ->causedBy($user)
        //     ->performedOn($event->response)
        //     ->withProperties(['notification_id' => $notification->id])
        //     ->event('notification_sent')
        //     ->log(__('logging.description.notification_sent', ['username' => $user->name, 'type' => $event->response->type]));
        // }
    }
}
