<?php

namespace App\Forms\Users;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Dictionary;
use Illuminate\Validation\Rules\File;
use App\Enums\Users\Gender;

class UserEditForm
{
    public static function boot($model = null): FormBuilder
    {
        $route = route('users.store');
        $method = 'POST';
        if(!is_null($model)){
            $method = 'PUT';
            $route = route('users.update', $model->id);
        }
        return (new FormBuilder($method, $route, 'users_edit'))
                ->class('users-create-form')
                ->add(FormElement::file('avatar')->label(__('forms.users.avatar'))->setExt(['.jpg', '.jpeg', '.png']))
                ->add(FormElement::text('firstname', $model)->label(__('forms.users.firstname')))
                ->add(FormElement::text('lastname', $model)->label(__('forms.users.lastname')))
                ->add(FormElement::text('email', $model)->label(__('forms.users.email')))
                ->add(FormElement::select('gender', $model, Dictionary::fromUnassocArray(Gender::values(), 'fields.gender'))
                ->label(__('forms.users.gender')))
                ->add(FormElement::date('birthday', $model)->label(__('forms.users.birthday')))

                ->addSubmit();
    }

    public static function validation(): array
    {
        return [
            'firstname' => 'max:255|required',
            'lastname' => 'max:255|required',
            'email' => 'max:255|email|required',
            'birthday' => 'date|nullable',
            // 'avatar' => [
            //     File::image()->types(['jpg', 'jpeg', 'png'])
            //         ->min(10)->max(4096),
            // ],
        ];
    }
}
