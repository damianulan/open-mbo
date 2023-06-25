<?php

namespace App\Facades\Forms\Elements;

class Trix extends Element
{

    public string $name;
    public ?string $value = null;
    public string $toolbar;

    public function __construct(string $name, string $toolbar = 'short', ?string $value)
    {
        $this->name = empty($name) ? null:$name;
        $this->value = $value;
        $this->toolbar = $toolbar;
    }
}