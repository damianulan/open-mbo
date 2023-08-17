<?php

namespace App\Forms\MBO;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Datetime;
use App\Facades\Forms\Elements\Dictionary;
use App\Models\MBO\ObjectiveTemplateCategory;

class ObjectiveTemplateEditForm
{

    public static function boot($model = null): FormBuilder
    {
        $route = route('management.objectives.store');
        $method = 'POST';
        if(!is_null($model)){
            $method = 'PUT';
            $route = route('management.objectives.update', $model->id);
        }
        return (new FormBuilder($method, $route, 'campaign_edit'))
                ->class('campaign-create-form')
                ->add(FormElement::select('category', $model, Dictionary::fromModel(ObjectiveTemplateCategory::class, 'name'))->label(__('forms.objectives.category')))
                ->add(FormElement::text('name', $model)->label(__('forms.objectives.name')))
                ->add(FormElement::trix('description', $model)->label(__('forms.objectives.description')))
                ->add(FormElement::numeric('goal', $model)->label(__('forms.objectives.goal')))
                ->add(FormElement::switch('draft', $model)->label(__('forms.objectives.draft'))->default(true)
                ->info('Proces będzie widoczny tylko dla administratorów i nie zostanie uruchomiony automatycznie.'))
                ->addSubmit();
    }

    public static function validation(): array
    {
        return [
            'name' => 'max:120|required',
            'period' => 'max:60|required|unique:campaigns,period',
            'description' => 'max:512|nullable',

            'draft' => 'in:on,off',
            'manual' => 'in:on,off',
        ];
    }
}
