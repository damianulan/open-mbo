<?php

namespace App\Forms\Settings;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Dictionary;

class GeneralForm
{
    public static function boot($model = null): FormBuilder
    {
        return (new FormBuilder('post', route('course.store'), 'course_create'))
                ->class('course-create-form')
                
                ->addSubmit();
    }
}
