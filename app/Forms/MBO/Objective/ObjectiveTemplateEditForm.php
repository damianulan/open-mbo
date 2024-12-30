<?php

namespace App\Forms\MBO\Objective;

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
        $route = route('management.mbo.objectives.store');
        $method = 'POST';
        if(!is_null($model)){
            $method = 'PUT';
            $route = route('management.mbo.objectives.update', $model->id);
        }

        return (new FormBuilder($method, $route, 'campaign_edit'))
                ->class('campaign-create-form')
                ->add(FormElement::select('category_id', $model, Dictionary::fromModel(ObjectiveTemplateCategory::class, 'name'))->label(__('forms.mbo.objectives.category')))
                ->add(FormElement::select('type', $model, Dictionary::fromEnum(ObjectiveType::class))->label(__('forms.mbo.objectives.type'))->required())
                ->add(FormElement::text('name', $model)->label(__('forms.mbo.objectives.name'))->required())
                ->add(FormElement::trix('description', $model)->label(__('forms.mbo.objectives.description')))
                ->add(FormElement::switch('draft', $model)->label(__('forms.mbo.objectives.draft'))->default(false)
                ->info(__('forms.mbo.objectives.info.draft')))
                ->addSubmit();
    }

    public static function validation($model_id = null): array
    {
        return [
            'category_id' => 'nullable',
            'type' => 'required',
            'name' => 'max:50|required',
            'description' => 'max:1000|nullable',
            'draft' => 'in:on,off',
        ];
    }
}
