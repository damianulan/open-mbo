<?php

namespace App\Forms\MBO\Objective;

use App\Models\MBO\UserObjective;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Ajax form
class ObjectiveEditUserRealizationForm extends Form
{
    /**
     * @param  UserObjective  $model
     */
    public function definition(): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Modyfikacja realizacji celu';
        $prefix = '';
        if ($model && Auth::user()->id === $model->user_id) {
            $prefix = 'self_';
        }

        return FormBuilder::boot($request, $method, $route, 'user_objective_edit_realization')
            ->class('objective-add-users-form')
            ->add(FormComponent::hidden('id', $model))
            ->add(FormComponent::decimal($prefix . 'realization', $model)->label(__('forms.mbo.objectives.users.realization'))->info(__('forms.mbo.objectives.users.info.realization')), fn () => $model && $model->objective->expected ?? false)
            ->add(FormComponent::decimal($prefix . 'evaluation', $model)->label(__('forms.mbo.objectives.users.evaluation'))->info(__('forms.mbo.objectives.users.info.evaluation')))
            ->authorize(fn () => $model && $model->canBeEvaluated())
            ->addTitle($title);
    }

    public function validation(): array
    {
        return array(
            'realization' => 'nullable|numeric',
            'evaluation' => 'nullable|numeric',
            'self_realization' => 'nullable|numeric',
            'self_evaluation' => 'nullable|numeric',
        );
    }
}
