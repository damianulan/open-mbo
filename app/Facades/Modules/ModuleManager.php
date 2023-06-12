<?php

namespace App\Facades\Modules;

use App\Facades\Modules\Module;
use App\Facades\Modules\ModuleModel;

class ModuleManager 
{
    public static function get()
    {
        if(empty(config('modules.manager'))){
            $records = ModuleModel::orderBy('order', 'ASC')->get();
            $output = new self();
            if(!empty($records))
            {
                foreach ($records as $record){
                    $module = new Module();
                    foreach($module as $key => $property){
                        $module->$key = $record->$key;
                    }
                    $output->{$module->name} = $module;
                }
            }
            config(['modules.manager' => $output]);
            return $output;   
        }
            
        return config('modules.manager');
    }
}