<?php

namespace App\Forms\Settings\Organization;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Http\Request;

class CompanyEditForm extends Form
{
    public function definition(): FormBuilder
    {
        $route = route('settings.organization.company.store');
        $method = 'POST';

        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $route = route('settings.organization.company.update', $this->model->id);
        }

        return FormBuilder::boot($method, $route, 'companies_edit')
            ->class('companies-create-form')
            ->add(FormComponent::text('firstname', $this->model)->label(__('forms.users.firstname')))
            ->add(FormComponent::text('lastname', $this->model)->label(__('forms.users.lastname')))
            ->add(FormComponent::text('email', $this->model)->label(__('forms.users.email')))
            ->add(FormComponent::date('birthday', $this->model)->label(__('forms.users.birthday')))
            ->addSubmit();
    }

    public function validation(): array
    {
        return array(
            'firstname' => 'max:255|required',
            'lastname' => 'max:255|required',
            'email' => 'max:255|email|required',
            'birthday' => 'date|nullable',
        );
    }
}
