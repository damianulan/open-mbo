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
use Illuminate\Http\Request;

class EmploymentEditForm extends Form
{
    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = route('employments.store');
        $method = 'POST';
        $user_id = $model->user_id ?? $request->get('user_id');

        if ( ! is_null($model)) {
            $method = 'PUT';
            $route = route('employments.update', $model->id);
        }

        return FormBuilder::boot($request, $method, $route, 'employments_edit')
            ->class('employments-edit-form')
            ->add(FormComponent::hidden('user_id', null, $user_id))
            ->add(FormComponent::select('company_id', $model, Dictionary::fromModel(Company::class, 'name'))
                ->label(__('forms.employments.company')))
            ->add(FormComponent::select('department_id', $model, Dictionary::fromModel(Department::class, 'name'))
                ->label(__('forms.employments.department')))
            ->add(FormComponent::select('position_id', $model, Dictionary::fromModel(Position::class, 'name'))
                ->label(__('forms.employments.position')))
            ->add(FormComponent::select('contract_id', $model, Dictionary::fromModel(TypeOfContract::class, 'name'))
                ->label(__('forms.employments.contract')))
            ->add(FormComponent::date('employment', $model)->label(__('forms.employments.employment')))
            ->add(FormComponent::date('release', $model)->label(__('forms.employments.release')))
            ->addSubmit()
            ->onCondition( ! is_null($model), function (FormBuilder $builder) use ($model): void {
                $builder->addButton(new Button(title: __('buttons.delete'), href: route('employments.delete', $model->id), classes: 'btn-danger delete-employment'));
            });
    }

    public static function validation(Request $request, $model = null): array
    {
        return array(
            'user_id' => 'required',
            'company_id' => 'required',
            'employment' => 'date|nullable',
            'release' => 'date|nullable',
        );
    }
}
