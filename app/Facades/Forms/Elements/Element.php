<?php

namespace App\Facades\Forms\Elements;

use Illuminate\Support\Str;

class Element
{

    public string $name;
    public string $type;
    public ?string $value = null;
    public ?string $template = null;

    public ?string $label = null;
    public ?string $placeholder = null;

    public array $classes = [];

    public bool $required = false;
    public bool $disabled = false;
    public bool $readonly = false;
    public bool $show = true;
    public string $autocomplete = '';

    public array $infos = [];
    public array $dangers = [];

    public function render()
    {
        $template = $this->template ?? Str::lower((new \ReflectionClass($this))->getShortName());
        return view('components.forms.elements.'.$template, [
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
                'required' => $this->required,
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

    public function info(string $text)
    {
        $this->infos[] = $text;
        return $this;
    }

    public function getInfos()
    {
        if(!empty($this->infos)){
            $output = '';
            foreach($this->infos as $info){
                $output .= '<span class="info-box" data-tippy-content="'.$info.'"><i class="bi-info-circle-fill"></i></span>';
            }
            return $output;
        }
        return null;
    }

    public function autocomplete(string $type)
    {
        $this->autocomplete = $type;
        return $this;
    }
}
