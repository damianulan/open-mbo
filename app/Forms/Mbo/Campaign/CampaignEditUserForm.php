<?php

namespace App\Forms\Mbo\Campaign;

use App\Contracts\Repositories\UserCampaignRepositoryContract;
use App\Models\Core\User;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;

class CampaignEditUserForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $method = 'POST';
        $title = 'Dodaj użytkowników do kampanii';
        $selected = [];
        $exclude = [];

        if ($this->model) {
            $this->model->loadMissing('coordinators');
            $user_ids = app(UserCampaignRepositoryContract::class)
                ->getAssignedUserIdsForCampaign($this->model->id);
            $coordinators = $this->model->coordinators->pluck('id')->toArray();

            if (! empty($user_ids)) {
                foreach ($user_ids as $tid) {
                    $selected[] = $tid;
                }
            }
            if (! empty($coordinators)) {
                foreach ($coordinators as $tid) {
                    $exclude[] = ['id' => $tid];
                }
            }
        }

        return $builder->setId('campaign_add_users')
            ->setMethod($method)
            ->class('campaign-add-users-form')
            ->add(FormComponent::hidden('id', $this->model))
            ->add(FormComponent::multiselect('user_ids', $selected, Dictionary::fromModel(User::class, 'name', 'allActive', $exclude))->required()->label(__('forms.campaigns.users.add')))
            ->setTitle($title);
    }

    public function validation(): array
    {
        return [];
    }
}
