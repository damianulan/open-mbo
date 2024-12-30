<?php

namespace App\Forms\MBO\Objective;

use App\Facades\Forms\Form;
use App\Facades\Forms\FormIO;
use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Datetime;
use App\Facades\Forms\Elements\Dictionary;
use App\Models\MBO\ObjectiveTemplateCategory;
use App\Enums\MBO\ObjectiveType;
use App\Models\Core\User;

class ObjectiveCategoryEditForm
{

    public static function boot($model = null): FormBuilder
    {
        $route = route('management.mbo.categories.store');
        $method = 'POST';
        $selected = array();
        $category = null;

        $shortnameType = 'text';
        if(!is_null($model)){
            $method = 'PUT';
            $route = route('management.mbo.categories.update', $model->id);
            $category = ObjectiveTemplateCategory::find($model->id);
            $selected = $category->coordinators->pluck('id')->toArray();
            if(in_array($category->shortname, ObjectiveTemplateCategory::baseCategories())){
                $shortnameType = 'hidden';
            }
        }

        return (new FormBuilder($method, $route, 'objective_category_edit'))
                ->class('objective-category-create-form')
                ->add(FormElement::text('name', $model)->label(__('forms.objectives.categories.name'))->required())
                ->add(FormElement::{$shortnameType}('shortname', $model)->label(__('forms.objectives.categories.shortname')))
                ->add(FormElement::trix('description', $model)->label(__('forms.objectives.categories.description')))
                ->add(FormElement::multiselect('user_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive'), 'users', $selected)->label(__('forms.objectives.categories.coordinators')))
                ->add(FormElement::switch('global', $model)->label(__('forms.objectives.categories.global'))->default(false)
                ->info(__('forms.objectives.categories.info.global')))
                ->addSubmit();
    }

    public static function validation($model_id = null): array
    {
        return [
            'name' => 'max:50|required',
            'shortname' => 'max:20|required|unique:objective_template_categories,shortname,'.$model_id,
            'description' => 'max:1000|nullable',
            'global' => 'in:on,off',
        ];
    }
}
