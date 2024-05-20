<?php

namespace App\Forms\MBO\Campaign;

use App\Facades\Forms\Form;
use App\Facades\Forms\FormIO;
use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Datetime;
use App\Facades\Forms\Elements\Dictionary;
use App\Enums\MBO\CampaignStage;
use App\Models\MBO\ObjectiveTemplate;

class CampaignEditObjective extends Form implements FormIO
{

    public static function boot($model = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj nowy cel do kampanii';
        if(!is_null($model)){
            $method = 'PUT';
            $title = 'Edytuj cel w ramach kampanii';
        }
        return FormBuilder::boot($method, $route, 'campaign_edit_objective')
                ->class('campaign-edit-objective-form')
                ->add(FormElement::select('template_id', $model, Dictionary::fromModel(ObjectiveTemplate::class, 'name', 'allActive'))->required()->label(__('forms.objectives.name')))
                ->add(FormElement::text('name', $model)->label(__('forms.objectives.name'))->required())
                ->add(FormElement::trix('description', $model)->label(__('forms.objectives.description')))
                ->add(FormElement::datetime('deadline')->label(__('forms.objectives.deadline')))
                ->add(FormElement::decimal('weight', $model)->label(__('forms.objectives.weight'))->required())
                ->add(FormElement::decimal('award', $model)->label(__('forms.objectives.award')))
                ->add(FormElement::switch('draft', $model)->label(__('forms.objectives.draft'))->default(true))
                ->addTitle($title);
    }

    public static function validation($model_id = null): array
    {
        return [
            'template_id' => 'required',
            'name' => 'max:120|required',
            'deadline' => 'datetime|nullable',
            'description' => 'max:512|nullable',
            'weight' => 'decimal:2|required',
            'award' => 'decimal:2|nullable',
            'draft' => 'in:on,off',
        ];
    }
}
