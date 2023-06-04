<?php

namespace App\Facades\Forms\Elements;

class Input extends Element
{
    public string $name;
    public string $type;
    public ?string $value = null;

    public ?int $maxlength = null;
    public ?int $minlength = null;

    public function __construct(string $name, string $type, ?string $value)
    {
        $this->name = empty($name) ? null:$name;
        $this->type = empty($type) ? null:$type;
        $this->value = $value;
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

}