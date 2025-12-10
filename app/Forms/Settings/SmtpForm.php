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

    public function definition(): FormBuilder
    {
        return FormBuilder::boot('post', route('settings.server.mail.store'), 'mail_settings')
            ->class('settings-form')
            ->add(FormComponent::text('mail_host', $this->model)->label(__('forms.settings.server.mail_host')))
            ->add(FormComponent::text('mail_port', $this->model)->numeric()->label(__('forms.settings.server.mail_port')))
            ->add(FormComponent::text('mail_username', $this->model)->label(__('forms.settings.server.mail_username')))
            ->add(FormComponent::password('mail_password', $this->model)->label(__('forms.generic.password')))
            ->add(FormComponent::select('mail_encryption', $this->model, Dictionary::fromAssocArray(array(
                'tls' => 'TLS',
                'ssl' => 'SSL',
                'starttls' => 'STARTTLS',
                'null' => 'PLAIN',
            )))->label(__('forms.settings.server.mail_encryption')))
            ->add(FormComponent::text('mail_from_address', $this->model)->label(__('forms.settings.server.mail_from_address')))
            ->add(FormComponent::text('mail_from_name', $this->model)->label(__('forms.settings.server.mail_from_name')))
            ->add(FormComponent::switch('mail_catchall_enabled', $this->model)->label(__('forms.settings.server.mail_catchall_enabled')))
            ->add(FormComponent::text('mail_catchall_receiver', $this->model)->label(__('forms.settings.server.mail_catchall_receiver')))

            ->addSubmit();
    }

    public function validation(): array
    {
        return array();
    }
}
