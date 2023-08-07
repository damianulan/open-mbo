<?php

namespace App\Facades\Forms\Elements;

use App\Facades\Forms\Elements\Datetime;

class Daterange extends Element
{

    public string $name;
    public array $elements = [];

    public function __construct(string $name, string $type, array $values = [])
    {
        $this->name = empty($name) ? null:$name;
        $this->elements = [
            (new Datetime($name . '_from', $type, $values['from']))->placeholder(__('forms.placeholders.choose_daterange_from')),
            (new Datetime($name . '_to', $type, $values['from']))->placeholder(__('forms.placeholders.choose_daterange_to')),
        ];

    }

    final public function render()
    {
        return view('components.forms.elements.daterange', [
            'elements' => $this->elements,
        ]);
    }

}
