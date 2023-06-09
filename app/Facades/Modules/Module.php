<?php

namespace App\Facades\Modules;

use App\Facades\Modules\ModuleModel;
use App\Facades\Modules\ModuleManager;

class Module
{

    public ?string $id = null;
    public ?string $name = null;
    public ?string $category = null;
    public ?string $icon = null;
    public bool $active = true;
    public int $order = 0;

    public function save()
    {
        $model = new ModuleModel();

        foreach($this as $key => $property)
        {
            $model->$key = $property;
        }

        if(!empty($model->id)){
            if($model->update()){
                return true;
            }
        } else {
            if($model->save()){
                return true;
            }
        }

        return false;
    }

    public function title()
    {
        $lang = 'menus.'.$this->name;
        if(is_array(__($lang))){
            $lang = 'menus.'.$this->name.'.index';
        }

        return __($lang);
    }
}