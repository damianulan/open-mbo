<?php

namespace App\Forms\MBO;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Datetime;
use App\Facades\Forms\Elements\Dictionary;
use App\Enums\CampaignStage;

class CampaignEditForm
{

    public static function boot($model = null): FormBuilder
    {
        $route = route('campaigns.store');
        $method = 'POST';
        if(!is_null($model)){
            $method = 'PUT';
            $route = route('campaigns.update', $model->id);
        }
        return (new FormBuilder($method, $route, 'campaign_edit'))
                ->class('campaign-create-form')
                ->add(FormElement::text('name', $model)->label(__('forms.campaigns.name')))
                ->add(FormElement::text('period', $model)->label(__('forms.campaigns.period'))
                ->info('Wprowadź unikalny reprezentatywny okres pomiaru, np. dla pomiaru co kwartał: 2023 Q3'))
                ->add(FormElement::trix('description', $model)->label(__('forms.campaigns.description')))

                ->add(FormElement::daterange(CampaignStage::DEFINITION->value, $model)->label(__('forms.campaigns.'.CampaignStage::DEFINITION->value))
                ->info('info'))
                ->add(FormElement::daterange(CampaignStage::DISPOSITION->value, $model)->label(__('forms.campaigns.'.CampaignStage::DISPOSITION->value))
                ->info('info'))
                ->add(FormElement::daterange(CampaignStage::REALIZATION->value, $model)->label(__('forms.campaigns.'.CampaignStage::REALIZATION->value))
                ->info('info'))
                ->add(FormElement::daterange(CampaignStage::EVALUATION->value, $model)->label(__('forms.campaigns.'.CampaignStage::EVALUATION->value))
                ->info('info'))
                ->add(FormElement::daterange(CampaignStage::SELF_EVALUATION->value, $model)->label(__('forms.campaigns.'.CampaignStage::SELF_EVALUATION->value))
                ->info('info'))
                ->add(FormElement::switch('draft', $model)->label(__('forms.campaigns.draft'))->default(true)
                ->info('Kampania będzie widoczna tylko dla administratorów i nie zostanie uruchomiona automatycznie.'))
                ->add(FormElement::switch('manual', $model)->label(__('forms.campaigns.manual'))->default(false)
                ->info('Przejście pomiędzy etapami nie będzie uzależnione od dat, a od podjęcia akcji przez administratora. Opcję tą można także włączyć w trakcie trwania kampanii.'))
                ->addSubmit();
    }

    public static function validation(): array
    {
        return [
            'name' => 'max:120|required',
            'period' => 'max:60|required|unique:campaigns,period',
            'description' => 'max:512|nullable',

            'definition_from' => 'date|required|after:today',
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
