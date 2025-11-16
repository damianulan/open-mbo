<?php

namespace App\Support\Notifications\Exceptions;

use Exception;

class ModelTraitNotUsed extends Exception
{
    public function __construct($model, $trait)
    {
        parent::__construct($model::class . ' does not use ' . $trait, 500);
    }
}
