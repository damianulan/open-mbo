<?php

namespace App\Facades\Forms\Elements;

use Illuminate\Http\Request;

class Datetime extends Element
{

    public string $name;
    public string $type;
    public ?string $value = null;

    public function __construct(string $name, string $type, ?string $value)
    {
        $this->name = empty($name) ? null:$name;
        $this->type = empty($type) ? null:$type;

        if(request()->old($name)){
            $this->value = date($this->getFormat(), strtotime( request()->old($name)) );
        }
        if(!$this->value){
            $this->value = empty($value) ? null:date($this->getFormat(), strtotime($value));
        }

        $this->classes[] = 'form-control';

        if($this->type){
            $this->classes[] = $this->type.'picker';
        }
        $this->placeholder(__('forms.placeholders.choose_'. $this->type));
    }

    public function getFormat(): string
    {
        $format = 'Y-m-d H:i:s';
        if($this->type === 'date'){
            $format = 'Y-m-d';
        } elseif ($this->type === 'time'){
            $format = 'H:i:s';
        }
        return $format;
    }

}
