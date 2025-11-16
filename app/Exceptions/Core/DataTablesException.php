<?php

namespace App\Exceptions\Core;

use Exception;

class DataTablesException extends Exception
{
    public function __construct($message = '')
    {
        parent::__construct($message);
    }
}
