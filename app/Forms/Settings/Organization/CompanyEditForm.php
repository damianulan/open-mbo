<?php

namespace App\Forms\Settings\Organization;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;

class CompanyEditForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $route = route('settings.organization.company.store');
        $method = 'POST';

        if (! is_null($this->model)) {
            $method = 'PUT';
            $route = route('settings.organization.company.update', $this->model);
        }

        return $builder->setId(is_null($this->model) ? 'company_create' : 'company_edit')
            ->setMethod($method)
            ->setAction($route)
            ->class('companies-create-form')
            ->add(FormComponent::text('name', $this->model)->label(__('forms.companies.name')))
            ->add(FormComponent::text('shortname', $this->model)->label(__('forms.companies.shortname')))
            ->add(FormComponent::text('taxpayerid', $this->model)->label(__('forms.companies.taxpayerid')))
            ->add(FormComponent::date('founded_at', $this->model)->label(__('forms.companies.founded_at')))
            ->add(FormComponent::container('description', $this->model)->label(__('forms.companies.description'))->class('quill-default')->purifyValue())
            ->addSubmit();
    }

    public function validation(): array
    {
        $companyId = request()->route('company');
        if (is_object($companyId)) {
            $companyId = $companyId->id;
        }

        if (empty($companyId)) {
            $companyId = $this->model?->id;
        }

        return [
            'name' => 'required|max:255|unique:companies,name,' . $companyId . ',id',
            'shortname' => 'required|max:128|unique:companies,shortname,' . $companyId . ',id',
            'taxpayerid' => 'nullable|max:255',
            'founded_at' => 'nullable|date',
            'description' => 'max:1000|nullable',
        ];
    }
}
