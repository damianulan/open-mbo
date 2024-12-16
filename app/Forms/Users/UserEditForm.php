<?php

namespace App\Forms\Users;

use App\Facades\Forms\Form;
use App\Facades\Forms\FormIO;
use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Dictionary;
use Illuminate\Validation\Rules\File;
use App\Enums\Users\Gender;
use App\Models\Core\Role;
use Illuminate\Validation\Rules\Enum;
use App\Models\Core\User;

class UserEditForm extends Form implements FormIO
{
    public static function boot($model = null): FormBuilder
    {
        $route = route('users.store');
        $method = 'POST';
        $exclude = array();
        $selected = array();
        $profile = null;
        if(!is_null($model)){
            $method = 'PUT';
            $route = route('users.update', $model->id);
            $profile = $model->profile;

            $selected = $model->supervisors->pluck('id')->toArray();
        }

        return (new FormBuilder($method, $route, 'users_edit'))
                ->class('users-create-form')
                ->add(FormElement::text('firstname', $profile)->label(__('forms.users.firstname')))
                ->add(FormElement::text('lastname', $profile)->label(__('forms.users.lastname')))
                ->add(FormElement::text('email', $model)->label(__('forms.users.email')))
                ->add(FormElement::select('gender', $profile, Dictionary::fromEnum(Gender::class))
                ->label(__('forms.users.gender')))
                ->add(FormElement::birthdate('birthday', $profile)->label(__('forms.users.birthday')))
                ->add(FormElement::multiselect('roles_ids', $model, Dictionary::fromAssocArray(Role::getSelectList()), 'roles')
                ->label(__('forms.users.roles')))
                ->add(FormElement::multiselect('supervisors_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive', $exclude), 'supervisors', $selected)
                ->label(__('forms.users.supervisors')))
                ->addSubmit();
    }

    public static function validation($model = null): array
    {
        return [
            'firstname' => 'max:255|required',
            'lastname' => 'max:255|required',
            'email' => 'max:255|email|required',
            'birthday' => 'date|nullable',
            'gender' => [new Enum(Gender::class)],
        ];
    }
}
