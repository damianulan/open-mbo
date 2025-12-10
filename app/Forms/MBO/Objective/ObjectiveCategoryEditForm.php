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
    public function definition(): FormBuilder
    {
        $route = route('categories.store');
        $method = 'POST';
        $selected = array();
        $category = null;

        $shortnameType = 'text';
        if ( ! is_null($this->model)) {
            $method = 'PUT';
            $route = route('categories.update', $this->model->id);
            $category = ObjectiveTemplateCategory::find($this->model->id);
            $selected = $category->coordinators->pluck('id')->toArray();
            if (in_array($category->shortname, ObjectiveTemplateCategory::baseCategories())) {
                $shortnameType = 'hidden';
            }
        }

        return FormBuilder::boot($method, $route, 'objective_category_edit')
            ->class('objective-category-create-form')
            ->add(FormComponent::text('name', $this->model)->label(__('forms.mbo.categories.name'))->required())
            ->add(FormComponent::{$shortnameType}('shortname', $this->model)->label(__('forms.mbo.categories.shortname')))
            ->add(FormComponent::container('description', $this->model)->label(__('forms.mbo.categories.description'))->class('quill-default'))
            ->add(FormComponent::multiselect('user_ids', $this->model, Dictionary::fromModel(User::class, 'name', 'allActive'), 'users', $selected)->label(__('forms.mbo.categories.coordinators')))
            ->addSubmit();
    }

    public function validation(): array
    {
        return array(
            'name' => 'max:50|required',
            'shortname' => 'max:20|required|unique:objective_template_categories,shortname,' . $this->model_id,
            'description' => 'max:1000|nullable',
        );
    }
}
