<?php

namespace App\Forms\Settings\Organization;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;

class PositionEditForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $route = route('settings.organization.positions.store');
        $method = 'POST';

        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $route = route('settings.organization.positions.update', $this->model->id);
        }

        return $builder->setId(is_null($this->model) ? 'position_create' : 'position_edit')
            ->setMethod($method)
            ->setAction($route)
            ->class('positions-create-form')
            ->add(FormComponent::text('name', $this->model)->label(__('forms.positions.name')))
            ->add(FormComponent::container('description', $this->model)->label(__('forms.positions.description'))->class('quill-default')->purifyValue())
            ->addSubmit();
    }

    public function validation(): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'max:1000|nullable',
        ];
    }
}
