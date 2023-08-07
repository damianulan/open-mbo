<?php

namespace App\Facades\Forms;

use App\Facades\Forms\Elements\Input;
use App\Facades\Forms\Elements\Checkbox;
use App\Facades\Forms\Elements\Select;
use App\Facades\Forms\Elements\Datetime;
use App\Facades\Forms\Elements\Daterange;
use App\Facades\Forms\Elements\File;
use App\Facades\Forms\Elements\Trix;
use Illuminate\Support\Collection;

class FormElement
{

    public static function text(string $name, $model = null): Input
    {
        $value = $model->$name ?? null;
        return new Input($name, 'text', $value);
    }

    public static function numeric(string $name, $model = null): Input
    {
        $value = $model->$name ?? null;
        return (new Input($name, 'text', $value))->numeric();
    }

    public static function password(string $name, $model = null): Input
    {
        $value = $model->$name ?? null;
        return new Input($name, 'password', $value);
    }

    public static function select(string $name, $model = null, Collection $options, $selected_value = null)
    {
        $value = $model->$name ?? null;

        if(!is_null($selected_value)){
            $value = $selected_value;
        }
        return new Select($name, $options, $value);
    }

    public static function trix(string $name, $model = null, string $toolbar = 'short')
    {
        $value = $model->$name ?? null;
        return new Trix($name, $toolbar, $value);
    }

    public static function datetime(string $name, $model = null): Datetime
    {
        $value = $model->$name ?? null;
        return new Datetime($name, 'datetime', $value);
    }

    public static function time(string $name, $model = null): Datetime
    {
        $value = $model->$name ?? null;
        return new Datetime($name, 'time', $value);
    }

    public static function date(string $name, $model = null): Datetime
    {
        $value = $model->$name ?? null;
        return new Datetime($name, 'date', $value);
    }

    public static function daterange(string $name, $model = null): Daterange
    {
        $from = $name . '_from';
        $to = $name . '_to';
        $values = [
            'from' => $model->$from ?? null,
            'to' => $model->$to ?? null,
        ];
        return new Daterange($name, 'date', $values);
    }

    public static function radio(string $name, $model = null): Checkbox
    {
        $value = $model->$name ?? null;
        return new Checkbox($name, 'radio', $value);
    }

    public static function checkbox(string $name, $model = null): Checkbox
    {
        $value = $model->$name ?? null;
        return new Checkbox($name, 'checkbox', $value);
    }

    public static function switch(string $name, $model = null): Checkbox
    {
        $value = $model->$name ?? null;
        return new Checkbox($name, 'switch', $value);
    }

    public static function file(string $name, $model = null): File
    {
        $value = false;
        if(isset($model->$name) && !empty($model->$name)){
            $value = true;
        }
        return new File($name, $value);
    }
}
