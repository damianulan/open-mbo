<?php

namespace App\Forms\MBO\Objective;

use App\Models\Core\User;
use App\Models\MBO\ObjectiveTemplateCategory;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Http\Request;

class ObjectiveCategoryEditForm extends Form
{
    public static function definition(Request $request, $model = null): FormBuilder
    {
        $route = route('categories.store');
        $method = 'POST';
        $selected = [];
        $category = null;

        $shortnameType = 'text';
        if (! is_null($model)) {
            $method = 'PUT';
            $route = route('categories.update', $model->id);
            $category = ObjectiveTemplateCategory::find($model->id);
            $selected = $category->coordinators->pluck('id')->toArray();
            if (in_array($category->shortname, ObjectiveTemplateCategory::baseCategories())) {
                $shortnameType = 'hidden';
            }
        }

        return FormBuilder::boot($request, $method, $route, 'objective_category_edit')
            ->class('objective-category-create-form')
            ->add(FormComponent::text('name', $model)->label(__('forms.mbo.categories.name'))->required())
            ->add(FormComponent::{$shortnameType}('shortname', $model)->label(__('forms.mbo.categories.shortname')))
            ->add(FormComponent::container('description', $model)->label(__('forms.mbo.categories.description'))->class('quill-default'))
            ->add(FormComponent::multiselect('user_ids', $model, Dictionary::fromModel(User::class, 'name', 'allActive'), 'users', $selected)->label(__('forms.mbo.categories.coordinators')))
            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [
            'name' => 'max:50|required',
            'shortname' => 'max:20|required|unique:objective_template_categories,shortname,'.$model_id,
            'description' => 'max:1000|nullable',
        ];
    }
}
