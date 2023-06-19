<?php

namespace App\Settings\Modules;

use Spatie\LaravelSettings\Settings;

class CourseSettings extends Settings
{

    //public string $course_setting;

    public static function group(): string
    {
        return 'courses';
    }

    public static function repository(): string
    {
        return 'modules';
    }
}