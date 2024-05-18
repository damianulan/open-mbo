<?php

namespace App\Forms\MBO\Campaign;

use App\Facades\Forms\Form;
use App\Facades\Forms\FormIO;
use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Datetime;
use App\Facades\Forms\Elements\Dictionary;
use App\Enums\CampaignStage;
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
                ->addTitle($title);
    }

    public static function validation($model_id = null): array
    {
        return [

        ];
    }
}
