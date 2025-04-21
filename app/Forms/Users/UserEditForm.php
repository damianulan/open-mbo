<?php

namespace App\Forms\Users;

use FormForge\Base\Form;
use Illuminate\Http\Request;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use Illuminate\Validation\Rules\File;
use App\Enums\Users\Gender;
use App\Models\Core\Role;
use Illuminate\Validation\Rules\Enum;
use App\Models\Core\User;

class UserEditForm extends Form
{
    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = route('users.store');
        $method = 'POST';
        $exclude = array();
        $selected = array();
        $profile = null;
        if (!is_null($model)) {
            $method = 'PUT';
            $route = route('users.update', $model->id);
            $profile = $model->profile;

            $selected = $model->supervisors->pluck('id')->toArray();
        }

        return FormBuilder::boot($method, $route, 'users_edit')
            ->class('users-create-form')
            ->add(FormComponent::text('firstname', $profile)->label(__('forms.users.firstname')))
            ->add(FormComponent::text('lastname', $profile)->label(__('forms.users.lastname')))
            ->add(FormComponent::text('email', $model)->label(__('forms.users.email')))
            ->add(FormComponent::select('gender', $profile, Dictionary::fromEnum(Gender::class))
                ->label(__('forms.users.gender')))
            ->add(FormComponent::birthdate('birthday', $profile)->label(__('forms.users.birthday')))
            ->add(FormComponent::multiselect('roles_ids', $model, Dictionary::fromAssocArray(Role::getSelectList()), 'roles')
                ->label(__('forms.users.roles')))
            ->add(FormComponent::multiselect('supervisors_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive', $exclude), 'supervisors', $selected)
                ->label(__('forms.users.supervisors')))
            ->addSubmit();
    }

    public static function validation(Request $request, $model = null): array
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
