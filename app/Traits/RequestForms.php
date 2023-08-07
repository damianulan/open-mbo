<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

trait RequestForms
{
    public static function fillFromRequest(Request $request, $id = null): self
    {
        $instance = null;
        if(is_null($id)){
            $instance = new self();
        } else {
            $instance = self::find($id);
        }
        foreach($request->all() as $property => $value){
            if(in_array($property, $instance->fillable)){
                if($value instanceof UploadedFile){
                    $file = $request->file($property);
                    if($file && isset($instance->storagePath)){
                        $name = $file->hashName();
                        $stored = $file->storeAs("public/$instance->storagePath", $name);
                        if($stored){
                            $publicPath = $instance->storagePath . '/' . $name;
                            $instance->$property = $publicPath;
                        }
                    }

                } else {
                    if(isset($instance->dates) && !empty($instance->dates) && self::isDate($property, $value, $instance->dates)){
                        $instance->$property = self::reformatDate($value);
                    } else {
                        $instance->$property = $value;
                    }
                }
            }
        }

        return $instance;
    }

    private static function isDate(string $property, string $value, array $dates): bool
    {
        if(!empty($value) && strtotime($value) !== false && (int) $value > 0 && in_array($property, $dates)){
            return true;
        }
        return false;
    }

    private static function reformatDate(string $value): string
    {
        $type = 'date';
        if(str_contains($value, ' ') && str_contains($value, ':')){
            $type = 'datetime';
        } elseif (str_contains($value, ':')){
            $type = 'time';
        }
        $format = $type . '_format';

        $date = Carbon::createFromFormat(config('app.'.$format), $value);
        if($date){
            return $date->format('Y-m-d H:i:s');
        }
        return $value;
    }
}
