<?php

namespace App\Facades\Forms\Elements;

use Illuminate\Support\Str;

class Element
{

    public string $name;
    public string $type;
    public ?string $value = null;

    public ?string $label = null;
    public ?string $placeholder = null;

    public array $classes = [];

    public bool $required = false;
    public bool $disabled = false;
    public bool $readonly = false;

    public function render()
    {
        $class = Str::lower((new \ReflectionClass($this))->getShortName());
        return view('components.forms.elements.'.$class, [
            'element' => $this,
            'classes' => $this->getClasses(),
        ]);
    }

    public function required()
    {
        $this->required = true;
        return $this;
    }

    public function disabled()
    {
        $this->disabled = true;
        return $this;
    }

    public function readonly()
    {
        $this->readonly = true;
        return $this;
    }

    public function placeholder(string $text)
    {
        $this->placeholder = empty($text) ? null:$text;
        return $this;
    }

    public function value (string $value)
    {
        $this->value = $value;
        return $this;
    }

    public function label(string $text)
    {
        $this->label = $text;
        return $this;
    }

    public function getLabel()
    {
        if(!empty($this->label) && !empty($this->name)){
            return view('components.forms.label', [
                'label' => $this->label,
                'name' => $this->name,
            ]);
        }
        return null;
    }

    public function class(... $classes)
    {
        if(!empty($classes))
        {
            foreach($classes as $class){
                $this->classes[] = $class;
            }
        }
        return $this;
    }

    private function getClasses()
    {
        return empty($this->classes) ? null:implode(' ', $this->classes);
    }
}