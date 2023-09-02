<?php

namespace App\Facades\Forms;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

trait RequestForms
{
    public static function fillFromRequest(Request $request, $id = null): static
    {
        $instance = null;
        if(is_null($id)){
            $instance = new static();
        } else {
            $instance = static::find($id);
        }
        foreach($request->all() as $property => $value){
            if(in_array($property, $instance->fillable)){
                // FILE
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
                    // ALL ELSE
                    if(!is_array($value)){
                        $value = trim($value);
                    }
                    $instance->$property = $value;
                }
            }
        }

        return $instance;
    }

}
