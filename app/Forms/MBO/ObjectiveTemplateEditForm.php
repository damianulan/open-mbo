<?php

namespace App\Forms\MBO;

use App\Facades\Forms\Form;
use App\Facades\Forms\FormIO;
use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Datetime;
use App\Facades\Forms\Elements\Dictionary;
use App\Models\MBO\ObjectiveTemplateCategory;
use App\Enums\MBO\ObjectiveType;

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
                ->add(FormElement::select('category_id', $model, Dictionary::fromModel(ObjectiveTemplateCategory::class, 'name'))->label(__('forms.objectives.category')))
                ->add(FormElement::select('type', $model, Dictionary::fromEnum(ObjectiveType::class))->label(__('forms.objectives.type')))
                ->add(FormElement::text('name', $model)->label(__('forms.objectives.name')))
                ->add(FormElement::trix('description', $model)->label(__('forms.objectives.description')))
                ->add(FormElement::switch('draft', $model)->label(__('forms.objectives.draft'))->default(true)
                ->info('Cel będzie widoczny tylko dla administratorów i nie będzie możliwy do dodania do procesu w Kampanii MBO.'))
                ->addSubmit();
    }

    public static function validation(): array
    {
        return [
            'category_id' => 'nullable',
            'name' => 'max:120|required',
            'description' => 'max:512|nullable',
            'draft' => 'in:on,off',
        ];
    }
}
