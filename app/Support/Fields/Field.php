<?php

namespace App\Support\Fields;

use Illuminate\Http\Request;
use App\Support\Fields\FieldModel;

class Field
{
    public $name;
    public $type;


    public static function boot(string $name, string $type) {}
}
