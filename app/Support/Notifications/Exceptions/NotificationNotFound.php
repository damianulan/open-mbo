<?php

namespace App\Support\Notifications\Exceptions;

use Exception;

class NotificationNotFound extends Exception
{
    public function __construct($notification)
    {
        if($notification instanceof \App\Support\Notifications\Models\Notification){
            $notification = $notification->key;
        } else {
            if(is_object($notification)){
                $notification = get_class($notification);
            }
        }

        parent::__construct("Notification with key $notification not found");
    }
}
