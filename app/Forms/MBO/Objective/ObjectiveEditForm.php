<?php

namespace App\Forms\MBO\Objective;

use App\Models\MBO\Objective;
use App\Models\MBO\ObjectiveTemplate;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;

// Ajax form
class ObjectiveEditForm extends Form
{
    // TODO - dodawanie użytkowników
    public function definition(FormBuilder $builder): FormBuilder
    {
        $method = 'POST';
        $title = 'Dodaj nowy cel';
        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $title = 'Edytuj cel';
        }

        return $builder->setId(is_null($this->model) ? 'objective_create' : 'objective_edit')
            ->setMethod($method)
            ->class('objective-edit-form')
            ->add(FormComponent::hidden('id', $this->model))
            ->add(FormComponent::select('template_id', $this->model, Dictionary::fromModel(ObjectiveTemplate::class, 'name'))->required()->label(__('forms.mbo.objectives.template')))
            ->add(FormComponent::text('name', $this->model)->label(__('forms.mbo.objectives.name'))->required())
            ->add(FormComponent::container('description', $this->model)->label(__('forms.mbo.objectives.description'))->class('quill-default')->purifyValue())
            ->add(FormComponent::datetime('deadline', $this->model)->label(__('forms.mbo.objectives.deadline'))->info(__('forms.mbo.objectives.info.deadline')))
            ->add(FormComponent::decimal('weight', $this->model)->label(__('forms.mbo.objectives.weight'))->info(__('forms.mbo.objectives.info.weight'))->required())
            ->add(FormComponent::decimal('expected', $this->model)->label(__('forms.mbo.objectives.expected'))->info(__('forms.mbo.objectives.info.expected')))
            ->add(FormComponent::decimal('award', $this->model)->label(__('forms.mbo.objectives.award'))->info(__('forms.mbo.objectives.info.award')))
            ->add(FormComponent::switch('draft', $this->model)->label(__('forms.mbo.objectives.draft'))->info(__('forms.mbo.objectives.info.draft'))->default(false))
            ->setTitle($title);
    }

    public function validation(): array
    {
        $builder = Objective::query();
        if ($this->model_id) {
            $builder->where('id', '!=', $this->model_id);
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
