<?php

namespace App\Forms\Settings\Organization;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;

class ContractTypeEditForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $route = route('settings.organization.contracts.store');
        $method = 'POST';

        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $route = route('settings.organization.contracts.update', $this->model->id);
        }

        return $builder->setId(is_null($this->model) ? 'contract_type_create' : 'contract_type_edit')
            ->setMethod($method)
            ->setAction($route)
            ->class('contract-types-create-form')
            ->add(FormComponent::text('name', $this->model)->label(__('forms.contracts.name')))
            ->add(FormComponent::container('description', $this->model)->label(__('forms.contracts.description'))->class('quill-default')->purifyValue())
            ->addSubmit();
    }

    public function validation(): array
    {
        $contractId = request()->route('contract');
        if (is_object($contractId)) {
            $contractId = $contractId->id;
        }

        if (empty($contractId)) {
            $contractId = $this->model?->id;
        }

        return [
            'name' => 'required|max:255|unique:type_of_contracts,name,' . $contractId . ',id',
            'description' => 'max:1000|nullable',
        ];
    }
}
