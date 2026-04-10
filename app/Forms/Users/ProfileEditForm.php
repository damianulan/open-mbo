<?php

namespace App\Forms\Users;

use App\Contracts\Repositories\UserRepositoryContract;
use Closure;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Validation\Rules\File;

class ProfileEditForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        if ($this->model) {
            app(UserRepositoryContract::class)->loadForBanner($this->model);
        }
        $profile = $this->model?->profile;

        return $builder->setId('profile_edit')
            ->setMethod('POST')
            ->setAction(route('profile.update'))
            ->class('profile-edit-form')
            ->add(FormComponent::file('avatar', $profile?->avatar)->label(__('forms.users.avatar')))
            ->add(FormComponent::text('firstname', $this->model)->label(__('forms.users.firstname')))
            ->add(FormComponent::text('lastname', $this->model)->label(__('forms.users.lastname')))
            ->add(FormComponent::text('email', $this->model)->label(__('forms.users.email')))
            ->add(FormComponent::birthdate('birthday', $profile)->label(__('forms.users.birthday')))
            ->addSubmit();
    }

    public function validation(): array
    {
        $userId = auth()->id();

        return [
            'avatar' => [
                'nullable',
                'image',
                File::types(['png', 'jpg', 'jpeg', 'svg'])
                    ->max('2mb'),
            ],
            'firstname' => 'max:255|required',
            'lastname' => 'max:255|required',
            'email' => [
                'max:255',
                'email',
                'required',
                function (string $attribute, mixed $value, Closure $fail) use ($userId): void {
                    $emailExists = app(UserRepositoryContract::class)
                        ->emailExistsForAnotherUser($value, $userId);

                    if ($emailExists) {
                        $fail(__('validation.unique', ['attribute' => $attribute]));
                    }
                },
            ],
            'birthday' => 'date|nullable',
        ];
    }
}
