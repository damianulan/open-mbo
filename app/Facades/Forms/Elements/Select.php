<?php

namespace App\Facades\Forms\Elements;

use Illuminate\Support\Collection;

class Select extends Element
{
    public string $name;
    public ?string $value = null;
    public Collection $options;
    public bool $multiple = false;
    public bool $empty_field = true;

    public function __construct(string $name, $options, $selected_value = null)
    {
        $this->name = empty($name) ? null:$name;
        $this->value = $selected_value;
        $this->options = $options;        
    }

    public function multiple()
    {
        $this->multiple = true;
        $this->classes[] = 'select-multiple';
        return $this;
    }

    public function noEmpty()
    {
        $this->empty_field = false;
        return $this;
    }

}