<?php

namespace App\Forms\MBO\Objective;

use App\Models\MBO\UserObjective;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Support\Facades\Auth;

// Ajax form
class ObjectiveEditUserRealizationForm extends Form
{
    /**
     * @param  UserObjective  $this->model
     */
    public function definition(FormBuilder $builder): FormBuilder
    {
        $method = 'POST';
        $title = 'Modyfikacja realizacji celu';
        $prefix = '';
        if ($this->model && Auth::user()->id === $this->model->user_id) {
            $prefix = 'self_';
        }

        return $builder->setId('user_objective_edit_realization')
            ->setMethod($method)
            ->class('objective-add-users-form')
            ->add(FormComponent::hidden('id', $this->model))
            ->add(FormComponent::decimal($prefix . 'realization', $this->model)->label(__('forms.mbo.objectives.users.realization'))->info(__('forms.mbo.objectives.users.info.realization')), fn () => $this->model && $this->model->objective->expected ?? false)
            ->add(FormComponent::decimal($prefix . 'evaluation', $this->model)->label(__('forms.mbo.objectives.users.evaluation'))->info(__('forms.mbo.objectives.users.info.evaluation')))
            ->authorize(fn () => $this->model && $this->model->canBeEvaluated())
            ->setTitle($title);
    }

    public function validation(): array
    {
        return [
            'realization' => 'nullable|numeric',
            'evaluation' => 'nullable|numeric',
            'self_realization' => 'nullable|numeric',
            'self_evaluation' => 'nullable|numeric',
        ];
    }
}
