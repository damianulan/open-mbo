<?php

namespace App\Exceptions\Core;

class DataTablesException extends \Exception
{
    public function __construct($message = '')
    {
        parent::__construct($message);
    }
}
