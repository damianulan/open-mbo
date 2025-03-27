<?php

namespace App\Forms\Management;

use App\Facades\Forms\Form;
use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Dictionary;
use Illuminate\Validation\Rules\File;
use App\Models\Core\Role;
use App\Models\Business\Company;

class CompanyEditForm extends Form
{
    public static function boot(?Company $model = null): FormBuilder
    {
        $route = route('management.organization.company.store');
        $method = 'POST';

        if(!is_null($model)){
            $method = 'PUT';
            $route = route('management.organization.company.update', $model->id);
        }
        return (new FormBuilder($method, $route, 'companies_edit'))
                ->class('companies-create-form')
                ->add(FormElement::text('firstname', $model)->label(__('forms.users.firstname')))
                ->add(FormElement::text('lastname', $model)->label(__('forms.users.lastname')))
                ->add(FormElement::text('email', $model)->label(__('forms.users.email')))
                ->add(FormElement::date('birthday', $model)->label(__('forms.users.birthday')))
                ->addSubmit();
    }

    public static function validation($model = null): array
    {
        return [
            'firstname' => 'max:255|required',
            'lastname' => 'max:255|required',
            'email' => 'max:255|email|required',
            'birthday' => 'date|nullable',
        ];
    }
}
