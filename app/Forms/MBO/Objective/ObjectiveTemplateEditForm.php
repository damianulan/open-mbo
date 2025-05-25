<?php

namespace App\Forms\MBO\Objective;

use FormForge\Base\Form;
use Illuminate\Http\Request;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use App\Models\MBO\ObjectiveTemplateCategory;

class ObjectiveTemplateEditForm extends Form
{

    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = route('management.mbo.objectives.store');
        $method = 'POST';
        if (!is_null($model)) {
            $method = 'PUT';
            $route = route('management.mbo.objectives.update', $model->id);
        }

        return FormBuilder::boot($request, $method, $route, 'campaign_edit')
            ->class('campaign-create-form')
            ->add(FormComponent::select('category_id', $model, Dictionary::fromModel(ObjectiveTemplateCategory::class, 'name'))->label(__('forms.mbo.objectives.category')))
            ->add(FormComponent::text('name', $model)->label(__('forms.mbo.objectives.name'))->required())
            ->add(FormComponent::trix('description', $model)->label(__('forms.mbo.objectives.description')))
            ->add(FormComponent::switch('draft', $model)->label(__('forms.mbo.objectives.draft'))->default(false)
                ->info(__('forms.mbo.objectives.info.draft')))
            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [
            'category_id' => 'nullable',
            'name' => 'max:50|required',
            'description' => 'max:1000|nullable',
            'draft' => 'boolean',
        ];
    }
}
