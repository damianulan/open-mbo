<?php

namespace App\Forms\Elearning\Courses;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Dictionary;

class CourseEditForm
{
    public static function boot($model = null): FormBuilder
    {
        return (new FormBuilder('post', route('courses.store'), 'course_create'))
                ->class('course-create-form')
                ->add(FormElement::text('name', $model)->label(__('forms.courses.name')))
                ->add(FormElement::trix('description', $model)->label(__('forms.courses.description')))
                ->add(FormElement::date('availability_from', $model)->label(__('forms.courses.available_from'))->info('info'))
                ->add(FormElement::date('availability_to', $model)->label(__('forms.courses.available_to')))
                ->add(FormElement::switch('public', $model)->label(__('forms.courses.public'))->default(true))
                ->add(FormElement::switch('visible', $model)->label(__('forms.courses.visible')))
                ->addSubmit();
    }
}
