<?php

namespace App\Forms\MBO\Objective;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Ajax form
class ObjectiveEditUserRealizationForm extends Form
{
    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Modyfikacja realizacji celu';
        $prefix = '';
        if (Auth::user()->id === $model->user_id) {
            $prefix = 'self_';
        }

        return FormBuilder::boot($request, $method, $route, 'user_objective_edit_realization')
            ->class('objective-add-users-form')
            ->add(FormComponent::hidden('id', $model))
            ->add(FormComponent::decimal($prefix.'realization', $model)->label(__('forms.mbo.objectives.users.realization'))->info(__('forms.mbo.objectives.users.info.realization')), function () use ($model) {
                return $model->objective->expected ?? false;
            })
            ->add(FormComponent::decimal($prefix.'evaluation', $model)->label(__('forms.mbo.objectives.users.evaluation'))->info(__('forms.mbo.objectives.users.info.evaluation')))
            ->addTitle($title);
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [
            'realization' => 'nullable|numeric',
            'evaluation' => 'nullable|numeric',
            'self_realization' => 'nullable|numeric',
            'self_evaluation' => 'nullable|numeric',
        ];
    }
}
