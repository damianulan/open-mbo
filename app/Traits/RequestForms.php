<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

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
                    $instance->$property = $value;
                }
            }
        }

        return $instance;
    }
}
