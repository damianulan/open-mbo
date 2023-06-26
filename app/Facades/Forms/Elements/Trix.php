<?php

namespace App\Facades\Forms\Elements;

use App\Facades\TrixField\TrixField;

class Trix extends Element
{

    public string $name;
    public ?string $value = null;
    public string $toolbar;

    public function __construct(string $name, string $toolbar = 'short', ?TrixField $value)
    {
        $this->name = empty($name) ? null:$name;
        $this->value = $value ? $value->get():null;
        $this->toolbar = $toolbar;
    }
}
