<?php

namespace App\Facades\Forms;

use App\Facades\Forms\FormBuilder;

interface FormIO
{
    public static function boot($model = null): FormBuilder;
    public static function validation(): array;
}
