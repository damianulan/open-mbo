<?php

namespace App\Forms\Settings;

use FormForge\Base\Form;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\Contracts\FormIO;
use App\Settings\MailSettings;

class SmtpForm extends Form implements FormIO
{
    public static function definition($model = null): FormBuilder
    {
        return FormBuilder::boot('post', route('settings.server.mail.store'), 'mail_settings')
            ->class('settings-form')
            ->add(FormComponent::text('mail_host', $model)->label(__('forms.settings.server.mail_host')))
            ->add(FormComponent::text('mail_port', $model)->numeric()->label(__('forms.settings.server.mail_port')))
            ->add(FormComponent::text('mail_username', $model)->label(__('forms.settings.server.mail_username')))
            ->add(FormComponent::password('mail_password', $model)->label(__('forms.generic.password')))
            ->add(FormComponent::select('mail_encryption', $model, Dictionary::fromCatalog('mail_encryption_methods'))
                ->label(__('forms.settings.server.mail_encryption')))
            ->add(FormComponent::text('mail_from_address', $model)->label(__('forms.settings.server.mail_from_address')))
            ->add(FormComponent::text('mail_from_name', $model)->label(__('forms.settings.server.mail_from_name')))
            ->add(FormComponent::switch('mail_catchall_enabled', $model)->label(__('forms.settings.server.mail_catchall_enabled')))
            ->add(FormComponent::text('mail_catchall_receiver', $model)->label(__('forms.settings.server.mail_catchall_receiver')))

            ->addSubmit();
    }

    public static function validation($model_id = null): array
    {
        return [];
    }
}
