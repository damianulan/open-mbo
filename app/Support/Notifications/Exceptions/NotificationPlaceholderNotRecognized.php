<?php

namespace App\Support\Notifications\Exceptions;

use Exception;

class NotificationPlaceholderNotRecognized extends Exception
{
    public function __construct()
    {
        parent::__construct('Notification placeholder cannot be of type object nor array');
    }
}
