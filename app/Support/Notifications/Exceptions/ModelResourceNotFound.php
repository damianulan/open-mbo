<?php

namespace App\Support\Notifications\Exceptions;

use App\Support\Notifications\Contracts\NotificationResource;
use Exception;

class ModelResourceNotFound extends Exception
{
    public function __construct($model)
    {
        parent::__construct('Notification Resource [' . NotificationResource::class . '] not found for model ' . $model::class, 500);
    }
}
