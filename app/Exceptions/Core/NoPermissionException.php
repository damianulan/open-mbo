<?php

namespace App\Exceptions\Core;

use App\Exceptions\AppException;

class NoPermissionException extends AppException
{
    public function __construct()
    {
        parent::__construct(__('alerts.error.no_permission'));
    }
}
