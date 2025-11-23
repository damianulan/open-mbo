<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
    public function __construct(?string $message = null)
    {
        $class = static::class;
        $message ??= __('exceptions.' . $class);
        parent::__construct($message);
    }
}
