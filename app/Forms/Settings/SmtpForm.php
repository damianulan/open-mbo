<?php

namespace App\Forms\Settings;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;

class SmtpForm
{
    public static function boot($model = null): FormBuilder
    {
        return (new FormBuilder('post', '', 'mail_settings'))
                ->class('settings-form')
                ->add(FormElement::text('mail_host', $model)->label(__('Host')))
                ->addSubmit();
    }
}
