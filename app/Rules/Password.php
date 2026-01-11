<?php

namespace App\Rules;

use Illuminate\Validation\Rules\Password as PasswordRule;

class Password extends PasswordRule
{
    public function __construct()
    {
        $min = 3;
        parent::__construct($min);
    }
}
