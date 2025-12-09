<?php

namespace App\Forms\MBO\Campaign;

use App\Enums\MBO\CampaignStage;
use App\Models\Core\User;
use App\Models\MBO\Campaign;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Http\Request;

class CampaignEditForm extends Form
{
    public function definition(): FormBuilder
    {
        $route = route('campaigns.store');
        $method = 'POST';
        $selected = array();
        $campaign = null;
        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $route = route('campaigns.update', $this->model->id);
            $campaign = Campaign::find($this->model->id);
            $selected = $campaign->coordinators->pluck('id')->toArray();
        }

        return FormBuilder::boot($method, $route, 'campaign_edit')
            ->class('campaign-create-form')
            ->add(FormComponent::text('name', $this->model)->label(__('forms.campaigns.name'))->required())
            ->add(FormComponent::text('period', $this->model)->label(__('forms.campaigns.period'))->required()
                ->info(__('forms.campaigns.info.period')))
            ->add(FormComponent::multiselect('user_ids', $this->model, Dictionary::fromModel(User::class, 'name', 'allActive'), 'users', $selected)->label(__('forms.campaigns.coordinators')))
            ->add(FormComponent::container('description', $this->model)->label(__('forms.campaigns.description'))->class('quill-default'))
            ->add(FormComponent::daterange(CampaignStage::DEFINITION, $this->model)->label(__('forms.campaigns.stages.' . CampaignStage::DEFINITION))->required()
                ->info(__('forms.campaigns.info.' . CampaignStage::DEFINITION)))
            ->add(FormComponent::daterange(CampaignStage::DISPOSITION, $this->model)->label(__('forms.campaigns.stages.' . CampaignStage::DISPOSITION))->required()
                ->info(__('forms.campaigns.info.' . CampaignStage::DISPOSITION)))
            ->add(FormComponent::daterange(CampaignStage::REALIZATION, $this->model)->label(__('forms.campaigns.stages.' . CampaignStage::REALIZATION))->required()
                ->info(__('forms.campaigns.info.' . CampaignStage::REALIZATION)))
            ->add(FormComponent::daterange(CampaignStage::EVALUATION, $this->model)->label(__('forms.campaigns.stages.' . CampaignStage::EVALUATION))->required()
                ->info(__('forms.campaigns.info.' . CampaignStage::EVALUATION)))
            ->add(FormComponent::daterange(CampaignStage::SELF_EVALUATION, $this->model)->label(__('forms.campaigns.stages.' . CampaignStage::SELF_EVALUATION))->required()
                ->info(__('forms.campaigns.info.' . CampaignStage::SELF_EVALUATION)))
            ->add(FormComponent::switch('draft', $this->model)->label(__('forms.campaigns.draft'))->default(true)
                ->info(__('forms.campaigns.info.draft')))
            ->add(FormComponent::switch('manual', $this->model)->label(__('forms.campaigns.manual'))->default(false)
                ->condition(fn () => settings('mbo.campaigns_manual'))->info(__('forms.campaigns.info.manual')))
            ->addSubmit();
    }

    public function validation(): array
    {
        return array(
            'name' => 'max:120|required',
            // 'period' => 'max:10|required|unique:campaigns,period,' . $this->model_id,
            'period' => 'max:10|required',
            'description' => 'max:1000|nullable',

            'definition_from' => 'nullable|date|required_if:manual,0',
            'definition_to' => 'nullable|date|required_if:manual,0|after_or_equal:definition_from',

            'disposition_from' => 'nullable|date|required_if:manual,0|after:definition_from',
            'disposition_to' => 'nullable|date|required_if:manual,0|after_or_equal:disposition_from',

            'realization_from' => 'nullable|date|required_if:manual,0|after:disposition_from',
            'realization_to' => 'nullable|date|required_if:manual,0|after_or_equal:realization_from',

            'evaluation_from' => 'nullable|date|required_if:manual,0|after:realization_from',
            'evaluation_to' => 'nullable|date|required_if:manual,0|after_or_equal:evaluation_from',

            'self_evaluation_from' => 'nullable|date|required_if:manual,0|after:evaluation_from',
            'self_evaluation_to' => 'nullable|date|required_if:manual,0|after_or_equal:self_evaluation_from',

            'draft' => 'boolean',
            'manual' => 'boolean',
        );
    }

    public function attributes(): array
    {
        return array_merge(CampaignStage::fromto_labels(), __('forms.campaigns'));
    }
}
