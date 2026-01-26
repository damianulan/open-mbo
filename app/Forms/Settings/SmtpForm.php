<?php

namespace App\Forms\Settings;

use App\Forms\Traits\SettingsForm;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;

class SmtpForm extends Form
{
    use SettingsForm;

    public function definition(FormBuilder $builder): FormBuilder
    {
        return $builder->setId('mail_settings')
            ->setMethod('post')
            ->setAction(route('settings.server.mail.store'))
            ->class('settings-form')
            ->add(FormComponent::text('mail_host', $this->mail_host)->label(__('forms.settings.server.mail_host')))
            ->add(FormComponent::text('mail_port', $this->mail_port)->numeric()->label(__('forms.settings.server.mail_port')))
            ->add(FormComponent::text('mail_username', $this->mail_username)->label(__('forms.settings.server.mail_username')))
            ->add(FormComponent::password('mail_password', $this->mail_username)->label(__('forms.generic.password')))
            ->add(FormComponent::select('mail_encryption', $this->mail_encryption, Dictionary::fromAssocArray([
                'tls' => 'TLS',
                'ssl' => 'SSL',
                'starttls' => 'STARTTLS',
                'null' => 'PLAIN',
            ]))->label(__('forms.settings.server.mail_encryption')))
            ->add(FormComponent::text('mail_from_address', $this->mail_from_address)->label(__('forms.settings.server.mail_from_address')))
            ->add(FormComponent::text('mail_from_name', $this->mail_from_name)->label(__('forms.settings.server.mail_from_name')))
            ->add(FormComponent::switch('mail_catchall_enabled', $this->mail_catchall_enabled)->label(__('forms.settings.server.mail_catchall_enabled')))
            ->add(FormComponent::text('mail_catchall_receiver', $this->mail_catchall_receiver)->label(__('forms.settings.server.mail_catchall_receiver')))

            ->addSubmit();
    }

    public function validation(): array
    {
        return [];
    }
}
