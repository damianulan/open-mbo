<?php

namespace App\Forms\MBO\Objective;

use App\Models\Core\User;
use App\Models\MBO\UserObjective;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Http\Request;

// Ajax form
class ObjectiveEditUserRealizationForm extends Form
{
    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Modyfikacja realizacji celu';

        return FormBuilder::boot($request, $method, $route, 'user_objective_edit_realization')
            ->class('objective-add-users-form')
            ->add(FormComponent::hidden('id', $model))
            ->add(FormComponent::decimal('realization', $model)->label(__('forms.mbo.objectives.users.realization'))->info(__('forms.mbo.objectives.users.info.realization')))
            ->add(FormComponent::decimal('evaluation', $model)->label(__('forms.mbo.objectives.users.evaluation'))->info(__('forms.mbo.objectives.users.info.evaluation')))
            ->addTitle($title);
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [
            'realization' => 'nullable|numeric',
            'evaluation' => 'nullable|numeric',
        ];
    }
}
