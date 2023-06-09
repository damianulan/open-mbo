<?php

namespace App\Facades\Forms\Elements;

class Select extends Element
{
    public string $name;
    public string $type;
    public ?string $value = null;
    public array  $options;

    public function __construct(string $name, array $options, $selected_value = null)
    {
        $this->name = empty($name) ? null:$name;
        $this->type = 'select';
        $this->value = $selected_value;
        foreach($options as $option){
            if(!$option instanceof Option){
                throw new \Exception("At least one of the options is not a derivative of an Option class!");die;
            }
            $this->options[] = $option;
        }
    }

}