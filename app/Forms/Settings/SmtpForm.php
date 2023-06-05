<?php

namespace App\Forms\Settings;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;

class SmtpForm
{
    public static function boot($model = null): FormBuilder
    {
        return (new FormBuilder('post', route('settings.server.mail.store'), 'mail_settings'))
                ->class('settings-form')
                ->add(FormElement::text('mail_host', $model)->label(__('forms.settings.server.mail_host')))
                ->add(FormElement::text('mail_port', $model)->label(__('forms.settings.server.mail_port')))
                ->add(FormElement::text('mail_username', $model)->label(__('forms.settings.server.mail_username')))
                ->add(FormElement::password('mail_password', $model)->label(__('forms.generic.password')))
                ->add(FormElement::text('mail_encryption', $model)->label(__('forms.settings.server.mail_encryption')))
                ->add(FormElement::text('mail_from_address', $model)->label(__('forms.settings.server.mail_from_address')))
                ->add(FormElement::text('mail_from_name', $model)->label(__('forms.settings.server.mail_from_name')))

                ->addSubmit();
    }
}
