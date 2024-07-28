<?php

namespace App\Forms\Settings;

use App\Facades\Forms\Form;
use App\Facades\Forms\Elements\Dictionary;
use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Settings\MailSettings;

class SmtpForm extends Form
{
    public static function boot($model = null): FormBuilder
    {
        return (new FormBuilder('post', route('settings.server.mail.store'), 'mail_settings'))
                ->class('settings-form')
                ->add(FormElement::text('mail_host', $model)->label(__('forms.settings.server.mail_host')))
                ->add(FormElement::text('mail_port', $model)->numeric()->label(__('forms.settings.server.mail_port')))
                ->add(FormElement::text('mail_username', $model)->label(__('forms.settings.server.mail_username')))
                ->add(FormElement::password('mail_password', $model)->label(__('forms.generic.password')))
                ->add(FormElement::select('mail_encryption', $model, Dictionary::fromCatalog('mail_encryption_methods'))
                ->label(__('forms.settings.server.mail_encryption')))
                ->add(FormElement::text('mail_from_address', $model)->label(__('forms.settings.server.mail_from_address')))
                ->add(FormElement::text('mail_from_name', $model)->label(__('forms.settings.server.mail_from_name')))
                ->add(FormElement::switch('mail_catchall_enabled', $model)->label(__('forms.settings.server.mail_catchall_enabled')))
                ->add(FormElement::text('mail_catchall_receiver', $model)->label(__('forms.settings.server.mail_catchall_receiver')))

                ->addSubmit();
    }
}
