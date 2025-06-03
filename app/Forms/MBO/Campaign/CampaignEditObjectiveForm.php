<?php

namespace App\Forms\MBO\Campaign;

use FormForge\Base\Form;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\Objective;
use Illuminate\Http\Request;
use App\Models\MBO\Campaign;
use Illuminate\Support\Carbon;

// Ajax form
class CampaignEditObjectiveForm extends Form
{

    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj nowy cel do kampanii';
        $campaign_id = $request->input('campaign_id') ?? null;
        $selectedTemplate = array();

        if (!is_null($model)) {
            $method = 'PUT';
            $title = 'Edytuj cel w ramach kampanii';
            if (!$campaign_id) {
                $campaign_id = $model->campaign_id;
            }
            if ($model->template_id) {
                $selectedTemplate = [$model->template_id];
            }
        }
        $campaign = Campaign::findOrFail($campaign_id);

        $template_ids = Objective::where('campaign_id', $campaign_id)->get()->pluck('template_id');
        $exclude = array();
        if (!empty($template_ids)) {
            foreach ($template_ids as $tid) {
                if (!in_array($tid, $selectedTemplate)) {
                    $exclude[] = ['id' => $tid];
                }
            }
        }

        $realization_from = Carbon::parse($campaign->realization_from)->format('Y-m-d');
        $realization_to = Carbon::parse($campaign->realization_to)->format('Y-m-d');

        return FormBuilder::boot($request, $method, $route, 'campaign_edit_objective')
            ->class('campaign-edit-objective-form')
            ->add(FormComponent::hidden('id', $model))
            ->add(FormComponent::select('template_id', $model, Dictionary::fromModel(ObjectiveTemplate::class, 'name', 'getAll', $exclude), $selectedTemplate)->required()->label(__('forms.mbo.objectives.template')))
            ->add(FormComponent::hidden('campaign_id', $model, $campaign_id))
            ->add(FormComponent::text('name', $model)->label(__('forms.mbo.objectives.name'))->required())
            ->add(FormComponent::trix('description', $model)->label(__('forms.mbo.objectives.description')))
            ->add(FormComponent::datetime('deadline', $model)->label(__('forms.mbo.objectives.deadline'))->minDate($realization_from)->maxDate($realization_to)->info(__('forms.mbo.objectives.info.deadline')))
            ->add(FormComponent::decimal('weight', $model)->label(__('forms.mbo.objectives.weight'))->info(__('forms.mbo.objectives.info.weight'))->required())
            ->add(FormComponent::decimal('expected', $model)->label(__('forms.mbo.objectives.expected'))->info(__('forms.mbo.objectives.info.expected')))
            ->add(FormComponent::decimal('award', $model)->label(__('forms.mbo.objectives.award'))->info(__('forms.mbo.objectives.info.award')))
            ->add(FormComponent::switch('draft', $model)->label(__('forms.mbo.objectives.draft'))->info(__('forms.mbo.objectives.info.draft'))->default(false))
            ->addTitle($title);
    }

    public static function validation(Request $request, $model_id = null): array
    {
        $campaign_id = $request->input('campaign_id') ?? null;
        $builder = Objective::where('campaign_id', $campaign_id);
        if ($model_id) {
            $builder->where('id', '!=', $model_id);
        }

        return [
            'template_id' => 'required',
            'name' => 'max:120|required',
            'deadline' => 'nullable',
            'description' => 'max:512|nullable',
            'weight' => 'decimal:2|required',
            'expected' => 'decimal:2|nullable',
            'award' => 'decimal:2|nullable',
            'draft' => 'boolean',
        ];
    }
}
