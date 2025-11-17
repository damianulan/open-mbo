<?php

namespace App\Factories\Charts\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;

class IncorrectModel extends Exception
{
    public function __construct(string $name, Model $model)
    {
        $class = $model::class;
        $message = "Chart '$name' does not accept model of type $class";
        parent::__construct($message);
    }
}
