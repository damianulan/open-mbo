<?php

namespace App\Facades\Forms;

use Illuminate\Http\Request;

class Form
{
    public static function reformatRequest(Request $request): Request
    {
        foreach($request->all() as $property => $value)
        {
            if(self::isDate($value)){
                if(str_contains($property, '_from') || str_contains($property, '_to')){
                    $value = self::formatDateSpan($property, $value);
                }
                $request->merge([$property => $value]);
            }
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
}
