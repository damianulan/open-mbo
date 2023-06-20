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
                ->add(FormElement::text('title', $model)->label(__('forms.courses.title')))
                ->add(FormElement::trix('description', $model)->label(__('forms.courses.description')))
                ->add(FormElement::date('available_from', $model)->label(__('forms.courses.available_from'))
                ->info('info'))
                ->add(FormElement::date('available_to', $model)->label(__('forms.courses.available_to')))
                ->add(FormElement::switch('public', $model)->label(__('forms.courses.public'))->default(true)
                ->info('Widoczny w katalogu kursów dla każdego użytkownika.'))
                ->add(FormElement::switch('visible', $model)->label(__('forms.courses.visible'))
                ->info('Szkolenie będzie ukryte w katalogu kursów oraz na listach do zapisu. Jedynie administratorzy mogą prowadzić zapisy na ukryte kursy.'))
                ->addSubmit();
    }

    public static function validation(): array
    {
        return [
            'title' => 'max:120|required',
            'description' => 'max:512|nullable',
            'available_from' => 'date|required',
            'available_to' => 'date|nullable',
            'public' => 'boolean|required',
            'visible' => 'boolean|required',
        ];
    }
}
