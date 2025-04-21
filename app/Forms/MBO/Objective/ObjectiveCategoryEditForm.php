<?php

namespace App\Forms\MBO\Objective;

use FormForge\Base\Form;
use FormForge\Contracts\FormIO;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use App\Models\MBO\ObjectiveTemplateCategory;
use App\Models\Core\User;
use Request;

class ObjectiveCategoryEditForm extends Form implements FormIO
{

    public static function definition($model = null): FormBuilder
    {
        $route = route('management.mbo.categories.store');
        $method = 'POST';
        $selected = array();
        $category = null;

        $shortnameType = 'text';
        if (!is_null($model)) {
            $method = 'PUT';
            $route = route('management.mbo.categories.update', $model->id);
            $category = ObjectiveTemplateCategory::find($model->id);
            $selected = $category->coordinators->pluck('id')->toArray();
            if (in_array($category->shortname, ObjectiveTemplateCategory::baseCategories())) {
                $shortnameType = 'hidden';
            }
        }

        return (new FormBuilder($method, $route, 'objective_category_edit'))
            ->class('objective-category-create-form')
            ->add(FormComponent::text('name', $model)->label(__('forms.mbo.categories.name'))->required())
            ->add(FormComponent::{$shortnameType}('shortname', $model)->label(__('forms.mbo.categories.shortname')))
            ->add(FormComponent::trix('description', $model)->label(__('forms.mbo.categories.description')))
            ->add(FormComponent::multiselect('user_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive'), 'users', $selected)->label(__('forms.mbo.categories.coordinators')))
            ->add(FormComponent::switch('global', $model)->label(__('forms.mbo.categories.global'))->default(false)
                ->info(__('forms.mbo.categories.info.global')))
            ->addSubmit();
    }

    public static function validation($model_id = null): array
    {
        return [
            'name' => 'max:50|required',
            'shortname' => 'max:20|required|unique:objective_template_categories,shortname,' . $model_id,
            'description' => 'max:1000|nullable',
            'global' => 'in:on,off',
        ];
    }
}
