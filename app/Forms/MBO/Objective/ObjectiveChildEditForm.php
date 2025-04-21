<?php

namespace App\Forms\MBO\Objective;

use FormForge\Base\Form;
use FormForge\Contracts\FormIO;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\Objective;
use Illuminate\Http\Request;

// Ajax form
class ObjectiveChildEditForm extends Form implements FormIO
{

    public static function definition($model = null, ?Request $request = null): FormBuilder
    {
        $route = null;
        $method = 'POST';
        $title = 'Dodaj nowy cel podrzędny';
        $parent_id = $request->input('parent_id') ?? null;
        $parent = Objective::find($parent_id);
        if (!is_null($model)) {
            $method = 'PUT';
            $title = 'Edytuj cel podrzędny';
        }
        $exclude = array();
        $template_ids = Objective::where('campaign_id', $parent->campaign_id)->get()->pluck('template_id');
        if (!empty($template_ids)) {
            foreach ($template_ids as $tid) {
                $exclude[] = ['id' => $tid];
            }
        }

        return FormBuilder::boot($method, $route, 'objective_edit_child')
            ->class('objective-edit-child-form')
            ->add(FormComponent::hidden('id', $model))
            ->add(FormComponent::select('template_id', $model, Dictionary::fromModel(ObjectiveTemplate::class, 'name', 'all', $exclude))->required()->label(__('forms.mbo.objectives.template')))
            ->add(FormComponent::hidden('parent_id', $model, $parent->id))
            ->add(FormComponent::text('name', $model)->label(__('forms.mbo.objectives.name'))->required())
            ->add(FormComponent::trix('description', $model)->label(__('forms.mbo.objectives.description')))
            ->add(FormComponent::datetime('deadline', $model)->label(__('forms.mbo.objectives.deadline'))->info(__('forms.mbo.objectives.info.deadline')))
            ->add(FormComponent::decimal('weight', $model)->label(__('forms.mbo.objectives.weight'))->info(__('forms.mbo.objectives.info.weight'))->required())
            ->add(FormComponent::decimal('expected', $model)->label(__('forms.mbo.objectives.expected'))->info(__('forms.mbo.objectives.info.expected'))->required(function () use ($parent) {
                return $parent->expected > 0;
            }))
            ->add(FormComponent::decimal('award', $model)->label(__('forms.mbo.objectives.award'))->info(__('forms.mbo.objectives.info.award'))->required(function () use ($parent) {
                return $parent->award > 0;
            }))
            ->add(FormComponent::switch('draft', $model)->label(__('forms.mbo.objectives.draft'))->info(__('forms.mbo.objectives.info.draft'))->default(false))
            ->addTitle($title);
    }

    public static function validation($model_id = null): array
    {
        $campaign_id = request()->input('campaign_id') ?? null;
        $builder = Objective::where('campaign_id', $campaign_id);
        if ($model_id) {
            $builder->where('id', '!=', $model_id);
        }

        return [
            'parent_id' => 'required',
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
