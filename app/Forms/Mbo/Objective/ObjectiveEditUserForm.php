<?php

namespace App\Forms\Mbo\Objective;

use App\Contracts\Repositories\UserObjectiveRepositoryContract;
use App\Models\Core\User;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;

class ObjectiveEditUserForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $method = 'POST';
        $title = 'Dodaj użytkowników do realizacji celu';
        $selected = [];
        $exclude = [];

        if ($this->model) {
            $user_ids = app(UserObjectiveRepositoryContract::class)
                ->getAssignedUserIdsForObjective($this->model->id);

            if (! empty($user_ids)) {
                foreach ($user_ids as $tid) {
                    $selected[] = $tid;
                }
            }
        }

        return $builder->setId('objective_add_users')
            ->setMethod($method)
            ->class('objective-add-users-form')
            ->add(FormComponent::hidden('id', $this->model))
            ->add(FormComponent::multiselect('user_ids', $selected, Dictionary::fromModel(User::class, 'name', 'allActive', $exclude))->required()->label(__('forms.mbo.objectives.users.add')))
            ->setTitle($title);
    }

    public function validation(): array
    {

        return [];
    }
}
