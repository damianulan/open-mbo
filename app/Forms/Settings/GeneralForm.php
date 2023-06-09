<?php

namespace App\Forms\Settings;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Option;

class SmtpForm
{
    public static function boot($model = null): FormBuilder
    {
        return (new FormBuilder('post', route('settings.general.store'), 'general_settings'))
                ->class('settings-form')
                ->add(FormElement::text('site_name', $model)->label(__('forms.settings.server.mail_host')))
                ->add(FormElement::select('theme', $model, [

                ])->label(__('forms.settings.server.mail_port')))

                ->addSubmit();
    }
}
