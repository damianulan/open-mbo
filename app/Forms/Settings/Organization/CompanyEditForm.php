<?php

namespace App\Forms\Settings\Organization;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;

class CompanyEditForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $route = route('settings.organization.company.store');
        $method = 'POST';

        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $route = route('settings.organization.company.update', $this->model->id);
        }

        return $builder->setId(is_null($this->model) ? 'company_create' : 'company_edit')
            ->setMethod($method)
            ->setAction($route)
            ->class('companies-create-form')
            ->add(FormComponent::text('firstname', $this->model)->label(__('forms.users.firstname')))
            ->add(FormComponent::text('lastname', $this->model)->label(__('forms.users.lastname')))
            ->add(FormComponent::text('email', $this->model)->label(__('forms.users.email')))
            ->add(FormComponent::date('birthday', $this->model)->label(__('forms.users.birthday')))
            ->addSubmit();
    }

    public function validation(): array
    {
        return [
            'firstname' => 'max:255|required',
            'lastname' => 'max:255|required',
            'email' => 'max:255|email|required',
            'birthday' => 'date|nullable',
        ];
    }
}
