<?php

namespace App\Forms\MBO\Campaign;

use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Models\MBO\ObjectiveTemplate;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

// Ajax form
class CampaignEditObjectiveForm extends Form
{
    public function definition(): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj nowy cel do kampanii';
        $campaign_id = $this->campaign_id;
        $selectedTemplate = array();

        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $title = 'Edytuj cel w ramach kampanii';
            if ( ! $campaign_id) {
                $campaign_id = $this->model->campaign_id;
            }
            if ($this->model->template_id) {
                $selectedTemplate = array($this->model->template_id);
            }
        }
        $campaign = Campaign::findOrFail($campaign_id);

        $template_ids = Objective::where('campaign_id', $campaign_id)->get()->pluck('template_id');
        $exclude = array();
        if ( ! empty($template_ids)) {
            foreach ($template_ids as $tid) {
                if ( ! in_array($tid, $selectedTemplate)) {
                    $exclude[] = array('id' => $tid);
                }
            }
        }

        $realization_from = Carbon::parse($campaign->realization_from)->format('Y-m-d');
        $realization_to = Carbon::parse($campaign->realization_to)->format('Y-m-d');

        return FormBuilder::boot($method, $route, 'campaign_edit_objective')
            ->class('campaign-edit-objective-form')
            ->add(FormComponent::hidden('id', $this->model))
            ->add(FormComponent::select('template_id', $this->model, Dictionary::fromModel(ObjectiveTemplate::class, 'name', 'getAll', $exclude), $selectedTemplate)->required()->label(__('forms.mbo.objectives.template')))
            ->add(FormComponent::hidden('campaign_id', $this->model, $campaign_id))
            ->add(FormComponent::text('name', $this->model)->label(__('forms.mbo.objectives.name'))->required())
            ->add(FormComponent::container('description', $this->model)->label(__('forms.mbo.objectives.description'))->class('quill-default'))
            ->add(FormComponent::datetime('deadline', $this->model)->label(__('forms.mbo.objectives.deadline'))->minDate($realization_from)->maxDate($realization_to)->info(__('forms.mbo.objectives.info.deadline')))
            ->add(FormComponent::decimal('weight', $this->model)->label(__('forms.mbo.objectives.weight'))->info(__('forms.mbo.objectives.info.weight'))->required())
            ->add(FormComponent::decimal('expected', $this->model)->label(__('forms.mbo.objectives.expected'))->info(__('forms.mbo.objectives.info.expected')))
            ->add(FormComponent::decimal('award', $this->model)->label(__('forms.mbo.objectives.award'))->info(__('forms.mbo.objectives.info.award')))
            ->add(FormComponent::switch('draft', $this->model)->label(__('forms.mbo.objectives.draft'))->info(__('forms.mbo.objectives.info.draft'))->default(false))
            ->addTitle($title);
    }

    public function validation(): array
    {
        $campaign_id = $this->campaign_id ?? null;
        if($campaign_id){
            $builder = Objective::where('campaign_id', $campaign_id);
            if ($this->model) {
                $builder->where('id', '!=', $this->model->id);
            }
        }

        return array(
            'template_id' => 'required',
            'name' => 'max:120|required',
            'deadline' => 'nullable',
            'description' => 'max:512|nullable',
            'weight' => 'numeric|required',
            'expected' => 'numeric|nullable',
            'award' => 'numeric|nullable',
            'draft' => 'boolean',
        );
    }
}
