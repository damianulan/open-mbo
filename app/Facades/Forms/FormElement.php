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

/**
 * FormElement to be collected by FormBuilder. Methods return input instructions (a field) and each represents field in form.
 *
 * @author Damian Ułan <damian.ulan@protonmail.com>
 */
class FormElement
{

    /**
     * Returns input instruction for simple text type.
     *
     * @param  string $name
     * @param  mixed  $model
     * @return Input
     */
    public static function text(string $name, $model = null): Input
    {
        $value = $model->$name ?? null;
        return new Input($name, 'text', $value);
    }

    /**
     * Returns numeric input instruction for text type requiring only numbers as input.
     *
     * @param  string $name
     * @param  mixed  $model
     * @return Input
     */
    public static function numeric(string $name, $model = null): Input
    {
        $value = $model->$name ?? null;
        return (new Input($name, 'text', $value))->numeric();
    }

    /**
     * Returns numeric input instruction for text type requiring numbers with two floating points as number.
     *
     * @param  string $name
     * @param  mixed  $model
     * @return Input
     */
    public static function decimal(string $name, $model = null): Input
    {
        $value = $model->$name ?? null;
        return (new Input($name, 'text', $value))->decimal();
    }

    /**
     * Returns input instruction for password type.
     *
     * @param  string $name
     * @param  mixed  $model
     * @return Input
     */
    public static function password(string $name, $model = null): Input
    {
        $value = $model->$name ?? null;
        return new Input($name, 'password', $value);
    }

    /**
     * Returns hidden input instruction for any type.
     *
     * @param  string $name
     * @param  mixed  $model
     * @param  mixed  $val
     * @return Input
     */
    public static function hidden(string $name, $model = null, $val = null): Input
    {
        $value = $model->$name ?? null;
        if(!$value && $val){
            $value = $val;
        }
        return new Input($name, 'hidden', $value);
    }

    /**
     * Returns single select type instruction pregenerated with chosen.js.
     *
     * @param  string          $name
     * @param  mixed           $model
     * @param  Collection|null $options
     * @param  mixed           $selected_value
     * @return void
     */
    public static function select(string $name, $model = null, ?Collection $options = null, $selected_value = null)
    {
        $value = $model->$name ?? null;

        if(is_object($value)){
            $value = $value->value;
        }
        if(!is_null($selected_value)){
            $value = $selected_value;
        }
        return new Select($name, $options, array($value));
    }

    /**
     * Returns multiple select type instruction pregenerated with chosen.js.
     *
     * @param  string          $name
     * @param  mixed           $model
     * @param  Collection|null $options
     * @param  mixed           $relation - method name for model relationships you want to use
     * @param  array           $selected_values
     * @return void
     */
    public static function multiselect(string $name, $model = null, ?Collection $options = null, $relation = null, $selected_values = [])
    {
        $values = array();
        if($relation && $model && $model->$relation){
            $values = $model->$relation->modelKeys() ?? array();
        }

        if(count($selected_values)){
            $values = $selected_values;
        }
        return (new Select($name, $options, $values))->multiple();
    }


    /**
     * Returns rich edited textarea type instruction pregenerated with trix.js.
     *
     * @param  string $name
     * @param  mixed  $model
     * @param  string $toolbar
     * @return Trix
     */
    public static function trix(string $name, $model = null, string $toolbar = 'short'): Trix
    {
        $value = $model->$name ?? null;
        return new Trix($name, $toolbar, $value);
    }

    /**
     * Returns date and time input instruction pregenerated with flatpickr.js.
     *
     * @param  string   $name
     * @param  mixed    $model
     * @return Datetime
     */
    public static function datetime(string $name, $model = null): Datetime
    {
        $value = $model->$name ?? null;
        return new Datetime($name, 'datetime', $value);
    }

    /**
     * Returns a time input instruction pregenerated with flatpickr.js.
     *
     * @param  string   $name
     * @param  mixed    $model
     * @return Datetime
     */
    public static function time(string $name, $model = null): Datetime
    {
        $value = $model->$name ?? null;
        return new Datetime($name, 'time', $value);
    }

    /**
     * Returns a date input instruction pregenerated with flatpickr.js.
     *
     * @param  string   $name
     * @param  mixed    $model
     * @return Datetime
     */
    public static function date(string $name, $model = null): Datetime
    {
        $value = $model->$name ?? null;
        return new Datetime($name, 'date', $value);
    }

    /**
     * Returns a date range type input instruction pregenerated with flatpickr.js.
     *
     * @param  string   $name
     * @param  mixed    $model
     * @return Daterange
     */
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

    /**
     * Returns a boolean radio type input instruction.
     *
     * @param  string   $name
     * @param  mixed    $model
     * @return Checkbox
     */
    public static function radio(string $name, $model = null): Checkbox
    {
        $value = $model->$name ?? null;
        return new Checkbox($name, 'radio', $value);
    }

    /**
     * Returns a boolean checkbox type input instruction.
     *
     * @param  string   $name
     * @param  mixed    $model
     * @return Checkbox
     */
    public static function checkbox(string $name, $model = null): Checkbox
    {
        $value = $model->$name ?? null;
        return new Checkbox($name, 'checkbox', $value);
    }

    /**
     * Returns a boolean switch type input instruction.
     *
     * @param  string   $name
     * @param  mixed    $model
     * @return Checkbox
     */
    public static function switch(string $name, $model = null): Checkbox
    {
        $value = $model->$name ?? null;
        return new Checkbox($name, 'switch', $value);
    }

    /**
     * Returns a file import type input instruction.
     *
     * @param  string   $name
     * @param  mixed    $model
     * @return Checkbox
     */
    public static function file(string $name, $model = null): File
    {
        $value = false;
        if(isset($model->$name) && !empty($model->$name)){
            $value = true;
        }
        return new File($name, $value);
    }

    public static function dynamicChecklist(string $name, $model = null)
    {

    }
}
