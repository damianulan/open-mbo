<?php

namespace App\Forms\MBO\Objective;

use App\Models\MBO\ObjectiveTemplateCategory;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Http\Request;

class ObjectiveTemplateEditForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $route = route('templates.store');
        $method = 'POST';
        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $route = route('templates.update', $this->model->id);
        }

        return $builder->setId(is_null($this->model) ? 'objective_template_create' : 'objective_template_edit')
            ->setMethod($method)
            ->setAction($route)
            ->class('campaign-create-form')
            ->add(FormComponent::select('category_id', $this->model, Dictionary::fromModel(ObjectiveTemplateCategory::class, 'name'))->label(__('forms.mbo.objectives.category')))
            ->add(FormComponent::text('name', $this->model)->label(__('forms.mbo.objectives.name'))->required())
            ->add(FormComponent::container('description', $this->model)->label(__('forms.mbo.objectives.description'))->class('quill-default')->purifyValue())
            ->add(FormComponent::switch('draft', $this->model)->label(__('forms.mbo.objectives.draft'))->default(false)
                ->info(__('forms.mbo.objectives.info.draft')))
            ->addSubmit();
    }

    public function validation(): array
    {
        return array(
            'category_id' => 'nullable',
            'name' => 'max:50|required',
            'description' => 'max:1000|nullable',
            'draft' => 'boolean',
        );
    }
}
