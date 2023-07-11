<?php

namespace App\Forms\Elearning\Courses;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Dictionary;
use App\Models\Elearning\CourseCategory;
use Illuminate\Validation\Rules\File;

class CourseEditForm
{
    public static function boot($model = null): FormBuilder
    {
        $route = route('courses.store');
        $method = 'POST';
        if(!is_null($model)){
            $method = 'PUT';
            $route = route('courses.update', $model->id);
        }
        return (new FormBuilder($method, $route, 'course_edit'))
                ->class('course-create-form')
                ->add(FormElement::text('title', $model)->label(__('forms.courses.title')))
                ->add(FormElement::select('category_id', $model, Dictionary::fromModel(CourseCategory::class, 'title', 'getPublic'))
                ->label(__('forms.courses.category'))->noEmpty())
                ->add(FormElement::trix('description', $model)->label(__('forms.courses.description')))
                ->add(FormElement::datetime('available_from', $model)->label(__('forms.courses.available_from'))
                ->info('info'))
                ->add(FormElement::datetime('available_to', $model)->label(__('forms.courses.available_to')))
                ->add(FormElement::file('picture')->label(__('forms.courses.picture'))->setExt(['.jpg', '.jpeg', '.png']))
                ->add(FormElement::switch('public', $model)->label(__('forms.courses.public'))->default(true)
                ->info('Widoczny w katalogu kursów dla każdego użytkownika.'))
                ->add(FormElement::switch('visible', $model)->label(__('forms.courses.visible'))
                ->info('Jeśli widoczność zostanie wyłączona, szkolenie będzie ukryte w katalogu kursów oraz na listach do zapisu. Jedynie administratorzy mogą prowadzić zapisy na ukryte kursy.'))
                ->addSubmit();
    }

    public static function validation(): array
    {
        return [
            'title' => 'max:120|required',
            'description' => 'max:512|nullable',
            'available_from' => 'date|required',
            'available_to' => 'date|nullable',
            'public' => 'in:on,off',
            'visible' => 'in:on,off',
            'picture' => [
                File::image()->types(['jpg', 'jpeg', 'png'])
                    ->min(10)->max(4096),
            ],
        ];
    }
}
