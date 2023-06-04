<?php

namespace App\Facades\Forms\Elements;

use Exception;

class Button
{
    public string $type;
    public string $class;
    public string $title;

    public function __contruct(string $title, string $type = 'button', $class = 'btn-primary')
    {
        $allowed_types = ['button', 'submit', 'reset'];
        if(in_array($type, $allowed_types)){
            $this->type = $type;
        }

        $this->class = $class;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.forms.elements.button', [
            'element' => $this,
        ]);
    }
}