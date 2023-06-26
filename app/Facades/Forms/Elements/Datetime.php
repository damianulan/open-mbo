<?php

namespace App\Facades\Forms\Elements;

class Datetime extends Element
{

    public string $name;
    public string $type;
    public ?string $value = null;

    public function __construct(string $name, string $type, ?string $value)
    {
        $this->name = empty($name) ? null:$name;
        $this->type = empty($type) ? null:$type;
        $this->value = $value;
        $this->classes[] = 'form-control';

        if($this->type){
            $this->classes[] = $this->type.'picker';
        }
        $this->placeholder(__('forms.placeholders.choose_'. $this->type));
    }
}
