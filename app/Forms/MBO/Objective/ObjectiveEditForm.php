<?php

namespace App\Forms\MBO\Objective;

use App\Models\MBO\Objective;
use App\Models\MBO\ObjectiveTemplate;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Http\Request;

// Ajax form
class ObjectiveEditForm extends Form
{
    // TODO - dodawanie użytkowników
    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj nowy cel';
        if (! is_null($model)) {
            $method = 'PUT';
            $title = 'Edytuj cel';
        }

        return FormBuilder::boot($request, $method, $route, 'objective_edit')
            ->class('objective-edit-form')
            ->add(FormComponent::hidden('id', $model))
            ->add(FormComponent::select('template_id', $model, Dictionary::fromModel(ObjectiveTemplate::class, 'name'))->required()->label(__('forms.mbo.objectives.template')))
            ->add(FormComponent::text('name', $model)->label(__('forms.mbo.objectives.name'))->required())
            ->add(FormComponent::trix('description', $model)->label(__('forms.mbo.objectives.description')))
            ->add(FormComponent::datetime('deadline', $model)->label(__('forms.mbo.objectives.deadline'))->info(__('forms.mbo.objectives.info.deadline')))
            ->add(FormComponent::decimal('weight', $model)->label(__('forms.mbo.objectives.weight'))->info(__('forms.mbo.objectives.info.weight'))->required())
            ->add(FormComponent::decimal('expected', $model)->label(__('forms.mbo.objectives.expected'))->info(__('forms.mbo.objectives.info.expected')))
            ->add(FormComponent::decimal('award', $model)->label(__('forms.mbo.objectives.award'))->info(__('forms.mbo.objectives.info.award')))
            ->add(FormComponent::switch('draft', $model)->label(__('forms.mbo.objectives.draft'))->info(__('forms.mbo.objectives.info.draft'))->default(false))
            ->addTitle($title);
    }

    public static function validation(Request $request, $model_id = null): array
    {
        $builder = Objective::query();
        if ($model_id) {
            $builder->where('id', '!=', $model_id);
        }

        return [
            'template_id' => 'required',
            'name' => 'max:120|required',
            'deadline' => 'nullable',
            'description' => 'max:2000|nullable',
            'weight' => 'numeric|required',
            'expected' => 'numeric|nullable',
            'award' => 'numeric|nullable',
            'draft' => 'boolean',
        ];
    }
}
