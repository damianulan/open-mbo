<?php

namespace App\Facades\Forms;

use App\Facades\Forms\Elements\Button;
use Illuminate\Support\Str;
use App\Facades\Forms\Elements\Element;

class FormBuilder
{
    private ?string $id;
    private string $method;
    private string $action;
    private string $template = 'horizontal';

    private array $classes = [];
    private array $elements = [];

    public Button $submit;

    public function __construct(string $method, string $action, string $id = null)
    {
        $this->method = Str::upper($method);
        $this->action = $action;
        $this->id = $id;
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

    public function add(Element $element)
    {
        if(!empty($element) && $element->show === true){
            $this->elements[] = $element;
        }
        return $this;
    }

    public function template(string $template)
    {
        $this->template = empty($template) ? null:$template;
        return $this;
    }

    private function getClasses()
    {
        return empty($this->classes) ? null:implode(' ', $this->classes);
    }

    public function addSubmit(string $class = 'btn-primary')
    {
        $this->submit = new Button(__('buttons.save'), 'submit', $class);
        return $this;
    }

    public function render()
    {
        return view('components.forms.templates.'. $this->template, [
            'elements'  => $this->elements,
            'method'    => $this->method,
            'action'    => $this->action,
            'classes'   => $this->getClasses(),
            'id'        => $this->id,
            'template'  => $this->template,
            'submit'    => $this->submit,
        ]);
    }
}
