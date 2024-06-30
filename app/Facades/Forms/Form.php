<?php

namespace App\Facades\Forms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Form
{

    public static function validation($model_id = null): array
    {
        return [];
    }

    public static function reformatRequest(Request $request): Request
    {
        foreach($request->all() as $property => $value)
        {
            if(self::isDate($value)){
                $value = self::formatDate($value);
                if(str_contains($property, '_from') || str_contains($property, '_to')){
                    $value = self::formatDateSpan($property, $value);
                }
            } elseif(self::isEUFloat($value)) {
                $value = str_replace(',','.',$value);
            } else {
                if(empty($value)){
                    $value = null;
                }
            }
            $request->merge([$property => $value]);
        }

        return $request;
    }

    private static function formatDateSpan(string $property, ?string $value): ?string
    {
        if($value){
            $type = str_contains($property, '_from') ? 'from':'to';

            if(str_contains($value, ' ')){
                // if already has hour
                $value = strtok($value);
            }

            if($type === 'from'){
                $value .= ' 00:00:00';
            }
            if($type === 'to'){
                $value .= ' 23:59:59';
            }
        }
        return $value;
    }

    private static function isDate(?string $value): bool
    {
        $timestamp = strtotime($value);
        if(!empty($value) && $timestamp !== false && $timestamp > 0 && $timestamp !== $value ){
            return true;
        }
        return false;
    }

    private static function formatDate(string $value)
    {
        return date('Y-m-d', strtotime($value));
    }

    private static function isEUFloat(?string $value)
    {
        if($value){
            if(strpos($value, ',') !== false){
                $values = explode(',', $value);
                $all_numeric = true;
                foreach($values as $v){
                    if((int) $v != $v) {
                        $all_numeric = false;
                    }
                }

                return $all_numeric;
            }

        }
        return false;
    }

    public static function validate(Request $request, $model = null): array
    {
        $validator = Validator::make($request->all(), static::validation($model));

        if($validator->fails()){
            return [
                'status' => 'error',
                'messages' => $validator->messages(),
            ];
        }
        return [
            'status' => 'ok',
            'messages' => $validator->messages(),
        ];
    }
}
