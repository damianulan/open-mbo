<?php

namespace App\Exceptions;

class AppException extends \Exception
{
    public function __construct(?string $message = null)
    {
        $class = static::class;
        $message = $message ?? __('exceptions.'.$class);
        parent::__construct($message);
    }
}
