<?php

namespace App\Facades\Fields;

use Illuminate\Http\Request;
use App\Facades\Fields\FieldModel;

class Field
{
    public $name;
    public $type;


    public static function boot(string $name, string $type)
    {

    }
}
