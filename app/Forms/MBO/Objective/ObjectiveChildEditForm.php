<?php

namespace App\Forms\MBO\Objective;

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
class ObjectiveChildEditForm extends Form implements FormIO
{

    public static function boot($model = null, ?Request $request = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj nowy cel podrzędny';
        $parent_id = $request->input('parent_id') ?? null;
        $parent = Objective::find($parent_id);
        if(!is_null($model)){
            $method = 'PUT';
            $title = 'Edytuj cel podrzędny';
        }
        $exclude = array();
        $template_ids = Objective::where('campaign_id', $parent->id)->get()->pluck('template_id');
        if(!empty($template_ids)){
            foreach($template_ids as $tid){
                $exclude[] = ['id' => $tid];
            }
        }

        return FormBuilder::boot($method, $route, 'objective_edit_child')
                ->class('objective-edit-child-form')
                ->add(FormElement::hidden('id', $model))
                ->add(FormElement::select('template_id', $model, Dictionary::fromModel(ObjectiveTemplate::class, 'name', 'allIndividual', $exclude))->required()->label(__('forms.mbo.objectives.template')))
                ->add(FormElement::hidden('parent_id', $model, $parent->id))
                ->add(FormElement::text('name', $model)->label(__('forms.mbo.objectives.name'))->required())
                ->add(FormElement::trix('description', $model)->label(__('forms.mbo.objectives.description')))
                ->add(FormElement::datetime('deadline', $model)->label(__('forms.mbo.objectives.deadline'))->info(__('forms.mbo.objectives.info.deadline')))
                ->add(FormElement::decimal('weight', $model)->label(__('forms.mbo.objectives.weight'))->info(__('forms.mbo.objectives.info.weight'))->required())
                ->add(FormElement::decimal('expected', $model)->label(__('forms.mbo.objectives.expected'))->info(__('forms.mbo.objectives.info.expected'))->required(function() use ($parent){
                    return $parent->expected > 0;
                }))
                ->add(FormElement::decimal('award', $model)->label(__('forms.mbo.objectives.award'))->info(__('forms.mbo.objectives.info.award')))
                ->add(FormElement::switch('draft', $model)->label(__('forms.mbo.objectives.draft'))->info(__('forms.mbo.objectives.info.draft'))->default(false))
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
