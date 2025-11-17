<?php

namespace App\Factories\Charts\Exceptions;

use Exception;

class ChartNotFound extends Exception
{
    public function __construct(string $name)
    {
        $message = "Given chart name: '{$name}' was not found";
        parent::__construct($message);
    }
}
