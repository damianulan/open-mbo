<?php

namespace App\Forms\Settings;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Http\Request;
use App\Forms\Traits\SettingsForm;

class SmtpForm extends Form
{
    use SettingsForm;

    public static function definition(Request $request, $model = null): FormBuilder
    {
        return FormBuilder::boot($request, 'post', route('settings.server.mail.store'), 'mail_settings')
            ->class('settings-form')
            ->add(FormComponent::text('mail_host', $model)->label(__('forms.settings.server.mail_host')))
            ->add(FormComponent::text('mail_port', $model)->numeric()->label(__('forms.settings.server.mail_port')))
            ->add(FormComponent::text('mail_username', $model)->label(__('forms.settings.server.mail_username')))
            ->add(FormComponent::password('mail_password', $model)->label(__('forms.generic.password')))
            ->add(FormComponent::select('mail_encryption', $model, Dictionary::fromAssocArray(array(
                'tls' => 'TLS',
                'ssl' => 'SSL',
                'starttls' => 'STARTTLS',
                'null' => 'PLAIN',
            )))->label(__('forms.settings.server.mail_encryption')))
            ->add(FormComponent::text('mail_from_address', $model)->label(__('forms.settings.server.mail_from_address')))
            ->add(FormComponent::text('mail_from_name', $model)->label(__('forms.settings.server.mail_from_name')))
            ->add(FormComponent::switch('mail_catchall_enabled', $model)->label(__('forms.settings.server.mail_catchall_enabled')))
            ->add(FormComponent::text('mail_catchall_receiver', $model)->label(__('forms.settings.server.mail_catchall_receiver')))

            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return array();
    }
}
