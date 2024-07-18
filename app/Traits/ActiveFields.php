<?php

namespace App\Traits;


trait ActiveFields
{

    public static function allActive()
    {
        $model = new static();
        if(isset($model->activeRules) && is_array($model->activeRules)){
            return static::where($model->activeRules)->get();
        }
        return static::all();
    }
}
