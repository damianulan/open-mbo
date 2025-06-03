<?php

namespace App\Forms\Settings\Organization;

use FormForge\Base\Form;
use Illuminate\Http\Request;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use Illuminate\Validation\Rules\File;
use App\Models\Core\Role;

class CompanyEditForm extends Form
{
    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = route('settings.organization.company.store');
        $method = 'POST';

        if (!is_null($model)) {
            $method = 'PUT';
            $route = route('settings.organization.company.update', $model->id);
        }
        return FormBuilder::boot($request, $method, $route, 'companies_edit')
            ->class('companies-create-form')
            ->add(FormComponent::text('firstname', $model)->label(__('forms.users.firstname')))
            ->add(FormComponent::text('lastname', $model)->label(__('forms.users.lastname')))
            ->add(FormComponent::text('email', $model)->label(__('forms.users.email')))
            ->add(FormComponent::date('birthday', $model)->label(__('forms.users.birthday')))
            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [
            'firstname' => 'max:255|required',
            'lastname' => 'max:255|required',
            'email' => 'max:255|email|required',
            'birthday' => 'date|nullable',
        ];
    }
}
