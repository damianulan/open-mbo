<?php

namespace App\Forms\Settings\Organization;

use App\Models\Core\User;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;

class TeamEditForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $route = route('settings.organization.team.store');
        $method = 'POST';
        $selectedUsers = [];
        $selectedLeaders = [];

        if (! is_null($this->model)) {
            $method = 'PUT';
            $route = route('settings.organization.team.update', $this->model->id);
            $this->model->loadMissing(['users', 'leaders']);
            $selectedUsers = $this->model->users->pluck('id')->toArray();
            $selectedLeaders = $this->model->leaders->pluck('id')->toArray();

            if (empty($selectedLeaders) && ! is_null($this->model->leader_id)) {
                $selectedLeaders[] = $this->model->leader_id;
            }
        }

        return $builder->setId(is_null($this->model) ? 'team_create' : 'team_edit')
            ->setMethod($method)
            ->setAction($route)
            ->class('teams-create-form')
            ->add(FormComponent::text('name', $this->model)->label(__('forms.teams.name')))
            ->add(FormComponent::multiselect('leaders_ids', $selectedLeaders, Dictionary::fromModel(User::class, 'name', 'allActive'))
                ->label(__('forms.teams.leaders')))
            ->add(FormComponent::multiselect('users_ids', $selectedUsers, Dictionary::fromModel(User::class, 'name', 'allActive'))
                ->label(__('forms.teams.users')))
            ->add(FormComponent::container('description', $this->model)->label(__('forms.teams.description'))->class('quill-default')->purifyValue())
            ->addSubmit();
    }

    public function validation(): array
    {
        $teamId = request()->route('team');
        if (is_object($teamId)) {
            $teamId = $teamId->id;
        }

        if (empty($teamId)) {
            $teamId = $this->model?->id;
        }

        return [
            'name' => 'required|max:255|unique:teams,name,' . $teamId . ',id',
            'leaders_ids' => 'required|array|min:1',
            'leaders_ids.*' => 'integer|exists:users,id',
            'users_ids' => 'nullable|array',
            'users_ids.*' => 'integer|exists:users,id',
            'description' => 'max:1000|nullable',
        ];
    }
}
