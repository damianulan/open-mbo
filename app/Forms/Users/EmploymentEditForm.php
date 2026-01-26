<?php

namespace App\Forms\Users;

use App\Models\Business\Company;
use App\Models\Business\Department;
use App\Models\Business\Position;
use App\Models\Business\TypeOfContract;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Button;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;

class EmploymentEditForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $route = route('employments.store');
        $method = 'POST';
        $user_id = $this->model?->user_id ?? $this->user_id;

        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $route = route('employments.update', $this->model->id);
        }

        return $builder->setId(is_null($this->model) ? 'employments_create' : 'employments_edit')
            ->setMethod($method)
            ->setAction($route)
            ->class('employments-edit-form')
            ->add(FormComponent::hidden('user_id', $user_id))
            ->add(FormComponent::select('company_id', $this->model, Dictionary::fromModel(Company::class, 'name'))
                ->label(__('forms.employments.company')))
            ->add(FormComponent::select('department_id', $this->model, Dictionary::fromModel(Department::class, 'name'))
                ->label(__('forms.employments.department')))
            ->add(FormComponent::select('position_id', $this->model, Dictionary::fromModel(Position::class, 'name'))
                ->label(__('forms.employments.position')))
            ->add(FormComponent::select('contract_id', $this->model, Dictionary::fromModel(TypeOfContract::class, 'name'))
                ->label(__('forms.employments.contract')))
            ->add(FormComponent::date('employment', $this->model)->label(__('forms.employments.employment')))
            ->add(FormComponent::date('release', $this->model)->label(__('forms.employments.release')))
            ->addSubmit()
            ->when( ! is_null($this->model), function (FormBuilder $builder): void {
                $builder->addButton(new Button(title: __('buttons.delete'), href: route('employments.delete', $this->model->id), classes: 'btn-danger delete-employment'));
            });
    }

    public function validation(): array
    {
        return [
            'user_id' => 'required',
            'company_id' => 'required',
            'employment' => 'date|nullable',
            'release' => 'date|nullable',
        ];
    }
}
