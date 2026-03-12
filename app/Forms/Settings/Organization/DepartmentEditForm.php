<?php

namespace App\Forms\Settings\Organization;

use App\Models\Business\Company;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;

class DepartmentEditForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $route = route('settings.organization.departments.store');
        $method = 'POST';

        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $route = route('settings.organization.departments.update', $this->model->id);
        }

        return $builder->setId(is_null($this->model) ? 'department_create' : 'department_edit')
            ->setMethod($method)
            ->setAction($route)
            ->class('departments-create-form')
            ->add(FormComponent::select('company_id', $this->model, Dictionary::fromModel(Company::class, 'name'))
                ->label(__('forms.departments.company')))
            ->add(FormComponent::text('name', $this->model)->label(__('forms.departments.name')))
            ->add(FormComponent::container('description', $this->model)->label(__('forms.departments.description'))->class('quill-default')->purifyValue())
            ->addSubmit();
    }

    public function validation(): array
    {
        return [
            'company_id' => 'required|uuid|exists:companies,id',
            'name' => 'required|max:255',
            'description' => 'max:1000|nullable',
        ];
    }
}
