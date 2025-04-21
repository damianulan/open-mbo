<?php

namespace App\Forms\MBO\Campaign;

use FormForge\Base\Form;
use Illuminate\Http\Request;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use App\Enums\MBO\CampaignStage;
use App\Models\Core\User;
use App\Models\MBO\Campaign;

class CampaignEditForm extends Form
{

    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = route('campaigns.store');
        $method = 'POST';
        $selected = array();
        $campaign = null;
        if (!is_null($model)) {
            $method = 'PUT';
            $route = route('campaigns.update', $model->id);
            $campaign = Campaign::find($model->id);
            $selected = $campaign->coordinators->pluck('id')->toArray();
        }
        return FormBuilder::boot($method, $route, 'campaign_edit')
            ->class('campaign-create-form')
            ->add(FormComponent::text('name', $model)->label(__('forms.campaigns.name'))->required())
            ->add(FormComponent::text('period', $model)->label(__('forms.campaigns.period'))->required()
                ->info('Wprowadź unikalny reprezentatywny okres pomiaru, np. dla pomiaru co kwartał: 2023 Q3'))
            ->add(FormComponent::multiselect('user_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive'), 'users', $selected)->label(__('forms.campaigns.coordinators')))
            ->add(FormComponent::trix('description', $model)->label(__('forms.campaigns.description')))

            ->add(FormComponent::daterange(CampaignStage::DEFINITION->value, $model)->label(__('forms.campaigns.' . CampaignStage::DEFINITION->value))->required()
                ->info(__('forms.campaigns.info.' . CampaignStage::DEFINITION->value)))
            ->add(FormComponent::daterange(CampaignStage::DISPOSITION->value, $model)->label(__('forms.campaigns.' . CampaignStage::DISPOSITION->value))->required()
                ->info(__('forms.campaigns.info.' . CampaignStage::DISPOSITION->value)))
            ->add(FormComponent::daterange(CampaignStage::REALIZATION->value, $model)->label(__('forms.campaigns.' . CampaignStage::REALIZATION->value))->required()
                ->info(__('forms.campaigns.info.' . CampaignStage::REALIZATION->value)))
            ->add(FormComponent::daterange(CampaignStage::EVALUATION->value, $model)->label(__('forms.campaigns.' . CampaignStage::EVALUATION->value))->required()
                ->info(__('forms.campaigns.info.' . CampaignStage::EVALUATION->value)))
            ->add(FormComponent::daterange(CampaignStage::SELF_EVALUATION->value, $model)->label(__('forms.campaigns.' . CampaignStage::SELF_EVALUATION->value))->required()
                ->info(__('forms.campaigns.info.' . CampaignStage::SELF_EVALUATION->value)))
            ->add(FormComponent::switch('draft', $model)->label(__('forms.campaigns.draft'))->default(true)
                ->info('Kampania będzie widoczna tylko dla administratorów i nie zostanie uruchomiona automatycznie.'))
            ->add(FormComponent::switch('manual', $model)->label(__('forms.campaigns.manual'))->default(false)
                ->info('Przejście pomiędzy etapami nie będzie uzależnione od dat, a od podjęcia akcji przez administratora. Opcję tą można także włączyć w trakcie trwania kampanii.'))
            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [
            'name' => 'max:120|required',
            'period' => 'max:10|required|unique:campaigns,period,' . $model_id,
            'description' => 'max:512|nullable',

            'definition_from' => 'date|required',
            'definition_to' => 'date|required|after_or_equal:definition_from',

            'disposition_from' => 'date|required|after:definition_from',
            'disposition_to' => 'date|required|after_or_equal:disposition_from',

            'realization_from' => 'date|required|after:disposition_from',
            'realization_to' => 'date|required|after_or_equal:realization_from',

            'evaluation_from' => 'date|required|after:realization_from',
            'evaluation_to' => 'date|required|after_or_equal:evaluation_from',

            'self_evaluation_from' => 'date|required|after:evaluation_from',
            'self_evaluation_to' => 'date|required|after_or_equal:self_evaluation_from',

            'draft' => 'in:on,off',
            'manual' => 'in:on,off',
        ];
    }
}
