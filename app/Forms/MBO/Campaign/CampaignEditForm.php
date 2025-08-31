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
    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = route('campaigns.store');
        $method = 'POST';
        $selected = [];
        $campaign = null;
        if (! is_null($model)) {
            $method = 'PUT';
            $route = route('campaigns.update', $model->id);
            $campaign = Campaign::find($model->id);
            $selected = $campaign->coordinators->pluck('id')->toArray();
        }

        return FormBuilder::boot($request, $method, $route, 'campaign_edit')
            ->class('campaign-create-form')
            ->add(FormComponent::text('name', $model)->label(__('forms.campaigns.name'))->required())
            ->add(FormComponent::text('period', $model)->label(__('forms.campaigns.period'))->required()
                ->info(__('forms.campaigns.info.period')))
            ->add(FormComponent::multiselect('user_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive'), 'users', $selected)->label(__('forms.campaigns.coordinators')))
            ->add(FormComponent::trix('description', $model)->label(__('forms.campaigns.description')))

            ->add(FormComponent::daterange(CampaignStage::DEFINITION, $model)->label(__('forms.campaigns.stages.'.CampaignStage::DEFINITION))->required()
                ->info(__('forms.campaigns.info.'.CampaignStage::DEFINITION)))
            ->add(FormComponent::daterange(CampaignStage::DISPOSITION, $model)->label(__('forms.campaigns.stages.'.CampaignStage::DISPOSITION))->required()
                ->info(__('forms.campaigns.info.'.CampaignStage::DISPOSITION)))
            ->add(FormComponent::daterange(CampaignStage::REALIZATION, $model)->label(__('forms.campaigns.stages.'.CampaignStage::REALIZATION))->required()
                ->info(__('forms.campaigns.info.'.CampaignStage::REALIZATION)))
            ->add(FormComponent::daterange(CampaignStage::EVALUATION, $model)->label(__('forms.campaigns.stages.'.CampaignStage::EVALUATION))->required()
                ->info(__('forms.campaigns.info.'.CampaignStage::EVALUATION)))
            ->add(FormComponent::daterange(CampaignStage::SELF_EVALUATION, $model)->label(__('forms.campaigns.stages.'.CampaignStage::SELF_EVALUATION))->required()
                ->info(__('forms.campaigns.info.'.CampaignStage::SELF_EVALUATION)))
            ->add(FormComponent::switch('draft', $model)->label(__('forms.campaigns.draft'))->default(true)
                ->info(__('forms.campaigns.info.draft')))
            ->add(FormComponent::switch('manual', $model)->label(__('forms.campaigns.manual'))->default(false)
                ->condition(function () {
                    return settings('mbo.campaigns_manual');
                })->info(__('forms.campaigns.info.manual')))
            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [
            'name' => 'max:120|required',
            // 'period' => 'max:10|required|unique:campaigns,period,' . $model_id,
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
        ];
    }
}
