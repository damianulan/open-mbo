<?php

namespace App\Forms\MBO;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Datetime;
use App\Facades\Forms\Elements\Dictionary;
use App\Enums\ProcessStage;

class ProcessEditForm
{

    public static function boot($model = null): FormBuilder
    {
        $route = route('process.store');
        $method = 'POST';
        if(!is_null($model)){
            $method = 'PUT';
            $route = route('process.update', $model->id);
        }
        return (new FormBuilder($method, $route, 'process_edit'))
                ->class('process-create-form')
                ->add(FormElement::text('name', $model)->label(__('forms.process.name')))
                ->add(FormElement::text('period', $model)->label(__('forms.process.period'))
                ->info('Wprowadź unikalny reprezentatywny okres pomiaru procesu, np. dla pomiaru co kwartał: 2023 Q3'))
                ->add(FormElement::trix('description', $model)->label(__('forms.process.description')))

                ->add(FormElement::daterange(ProcessStage::DEFINITION->value, $model)->label(__('forms.process.'.ProcessStage::DEFINITION->value))
                ->info('info'))
                ->add(FormElement::daterange(ProcessStage::DISPOSITION->value, $model)->label(__('forms.process.'.ProcessStage::DISPOSITION->value))
                ->info('info'))
                ->add(FormElement::daterange(ProcessStage::REALIZATION->value, $model)->label(__('forms.process.'.ProcessStage::REALIZATION->value))
                ->info('info'))
                ->add(FormElement::daterange(ProcessStage::EVALUATION->value, $model)->label(__('forms.process.'.ProcessStage::EVALUATION->value))
                ->info('info'))
                ->add(FormElement::daterange(ProcessStage::SELF_EVALUATION->value, $model)->label(__('forms.process.'.ProcessStage::SELF_EVALUATION->value))
                ->info('info'))
                ->add(FormElement::switch('draft', $model)->label(__('forms.process.draft'))->default(true)
                ->info('Proces będzie widoczny tylko dla administratorów i nie zostanie uruchomiony automatycznie.'))
                ->add(FormElement::switch('manual', $model)->label(__('forms.process.manual'))->default(false)
                ->info('Przejście pomiędzy etapami nie będzie uzależnione od dat, a od podjęcia akcji przez administratora. Opcję tą można także włączyć w trakcie trwania procesu.'))
                ->addSubmit();
    }

    public static function validation(): array
    {
        return [
            'name' => 'max:120|required',
            'period' => 'max:60|required|unique:processes,period',
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
