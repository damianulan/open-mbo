<?php

namespace App\Facades\Forms;

use App\Facades\Forms\Elements\Input;
use App\Facades\Forms\Elements\Checkbox;
use App\Facades\Forms\Elements\Select;
use App\Facades\Forms\Elements\Trix;
use Illuminate\Support\Collection;

class FormElement
{

    public static function text(string $name, $model = null): Input
    {
        $value = $model->$name ?? null;
        return new Input($name, 'text', $value);
    }

    public static function password(string $name, $model = null): Input
    {
        if(!is_null($model)){
            $value = $model->$name ?? null;
        }
        return new Input($name, 'password', $value);
    }

    public static function select(string $name, $model = null, Collection $options, $selected_value = null)
    {
        if(!is_null($model)) {
            $value = $model->$name ?? null;
        }
        if(!is_null($selected_value)){
            $value = $selected_value ?? null;
        }
        return new Select($name, $options, $value);
    }

    public static function trix(string $name, $model = null, string $toolbar = 'short')
    {
        if(!is_null($model)) {
            $value = $model->$name ?? null;
        }
        return new Trix($name, $toolbar, $value);
    }
    
}