<?php

namespace App\Facades\Forms\Elements;

class Input extends Element
{
    public string $name;
    public string $type;
    public ?string $value = null;

    public ?int $maxlength = null;
    public ?int $minlength = null;

    public bool $numeric = false;
    public string $numeric_type = 'integer';

    public function __construct(string $name, string $type, ?string $value)
    {
        $this->name = empty($name) ? null:$name;
        $this->type = empty($type) ? null:$type;
        $this->value = $value;
        $this->classes[] = 'form-control';
    }

    public function maxlength(int $value)
    {
        $this->maxlength = $value;
        return $this;
    }

    public function minlength(int $value)
    {
        $this->minlength = $value;
        return $this;
    }

    public function numeric()
    {
        $this->numeric = true;
        $this->placeholder('Wprowadź liczbę...');
        return $this;
    }

    public function decimal()
    {
        $this->numeric = true;
        $this->numeric_type = __FUNCTION__;
        $this->placeholder('Wprowadź liczbę do dwóch miejsc dziesiętnych...');
        return $this;
    }

}
