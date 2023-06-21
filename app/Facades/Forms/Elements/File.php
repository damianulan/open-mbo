<?php

namespace App\Facades\Forms\Elements;

class File extends Element
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = empty($name) ? null:$name;
        $this->classes[] = 'form-control';  
    }
}