<?php

namespace App\Forms\Users;

use App\Enums\Users\Gender;
use App\Models\Core\User;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Button;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Http\Request;
use Sentinel\Models\Role;

class UserEditForm extends Form
{
    public function definition(): FormBuilder
    {
        $route = route('users.store');
        $method = 'POST';
        $exclude = array();
        $selected = array();
        $profile = null;
        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $route = route('users.update', $this->model->id);
            $profile = $this->model->profile;

            $selected = $this->model->supervisors->pluck('id')->toArray();
        }

        return FormBuilder::boot($method, $route, 'users_edit')
            ->class('users-create-form')
            ->add(FormComponent::text('firstname', $profile)->label(__('forms.users.firstname')))
            ->add(FormComponent::text('lastname', $profile)->label(__('forms.users.lastname')))
            ->add(FormComponent::text('email', $this->model)->label(__('forms.users.email')))
            ->add(FormComponent::select('gender', $profile, Dictionary::fromEnum(Gender::class))
                ->label(__('forms.users.gender')))
            ->add(FormComponent::birthdate('birthday', $profile)->label(__('forms.users.birthday')))
            ->add(FormComponent::multiselect('roles_ids', $this->model, Dictionary::fromAssocArray(Role::getSelectList()), 'roles')
                ->label(__('forms.users.roles')))
            ->add(FormComponent::multiselect('supervisors_ids', $this->model, Dictionary::fromModel(User::class, 'name', 'allActive', $exclude), 'supervisors', $selected)
                ->label(__('forms.users.supervisors')))
            ->when( ! is_null($this->model), function (FormBuilder $builder): void {
                $builder->addButton(new Button(title: __('buttons.add_employment'), classes: 'btn-outline-primary add-employment'));
            })
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
