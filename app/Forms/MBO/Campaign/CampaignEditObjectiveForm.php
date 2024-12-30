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
use App\Models\MBO\Objective;
use Illuminate\Http\Request;

// Ajax form
// TODO PRIORYTETY
class CampaignEditObjectiveForm extends Form implements FormIO
{

    public static function boot($model = null, ?Request $request = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj nowy cel do kampanii';
        $campaign_id = $request->input('campaign_id') ?? null;
        if(!is_null($model)){
            $method = 'PUT';
            $title = 'Edytuj cel w ramach kampanii';
        }
        $template_ids = Objective::where('campaign_id', $campaign_id)->get()->pluck('template_id');
        $exclude = array();
        if(!empty($template_ids)){
            foreach($template_ids as $tid){
                $exclude[] = ['id' => $tid];
            }
        }

        return FormBuilder::boot($method, $route, 'campaign_edit_objective')
                ->class('campaign-edit-objective-form')
                ->add(FormElement::hidden('id', $model))
                ->add(FormElement::select('template_id', $model, Dictionary::fromModel(ObjectiveTemplate::class, 'name', 'allIndividual', $exclude))->required()->label(__('forms.objectives.name')))
                ->add(FormElement::hidden('campaign_id', $model, $campaign_id))
                ->add(FormElement::text('name', $model)->label(__('forms.objectives.name'))->required())
                ->add(FormElement::trix('description', $model)->label(__('forms.objectives.description')))
                ->add(FormElement::datetime('deadline', $model)->label(__('forms.objectives.deadline'))->info(__('forms.objectives.info.deadline')))
                ->add(FormElement::decimal('weight', $model)->label(__('forms.objectives.weight'))->info(__('forms.objectives.info.weight'))->required())
                ->add(FormElement::decimal('expected', $model)->label(__('forms.objectives.expected'))->info(__('forms.objectives.info.expected')))
                ->add(FormElement::decimal('award', $model)->label(__('forms.objectives.award'))->info(__('forms.objectives.info.award')))
                ->add(FormElement::switch('draft', $model)->label(__('forms.objectives.draft'))->info(__('forms.objectives.info.draft'))->default(false))
                ->addTitle($title);
    }

    public static function validation($model_id = null): array
    {
        $campaign_id = request()->input('campaign_id') ?? null;
        $builder = Objective::where('campaign_id', $campaign_id);
        if($model_id){
            $builder->where('id', '!=', $model_id);
        }

        $weights = $builder->get()->pluck('weight');
        $max_weight = 1;
        foreach($weights as $weight){
            $max_weight = $max_weight - (float) $weight;
        }

        return [
            'template_id' => 'required',
            'name' => 'max:120|required',
            'deadline' => 'nullable',
            'description' => 'max:512|nullable',
            'weight' => 'decimal:2|required',
            'expected' => 'decimal:2|nullable',
            'award' => 'decimal:2|nullable',
            'draft' => 'in:on,off',
        ];
    }
}
