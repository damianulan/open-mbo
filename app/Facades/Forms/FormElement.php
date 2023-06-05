<?php

namespace App\Facades\Forms;

use App\Facades\Forms\Elements\Input;
use App\Facades\Forms\Elements\Checkbox;
use App\Facades\Forms\Elements\Select;

class FormElement
{

    public static function text(string $name, $model = null): Input
    {
        $value = $model->$name ?? null;
        return new Input($name, 'text', $value);
    }

    public static function password(string $name, $model = null): Input
    {
        $value = $model->$name ?? null;
        return new Input($name, 'password', $value);
    }

    public static function select(string $name, $model = null, $options = [])
    {

    }
    
}