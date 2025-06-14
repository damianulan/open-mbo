<?php

namespace App\Listeners\Activity;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\Events\NotificationSent;
use App\Models\Core\User;

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
