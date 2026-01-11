<?php

namespace App\Forms\Settings;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Http\Request;
use App\Forms\Traits\SettingsForm;

class NotificationsForm extends Form
{
    use SettingsForm;

    protected static ?string $backRoute = 'settings.modules.index';

    protected static array $backParams = array('module' => 'notifications');

    public function definition(FormBuilder $builder): FormBuilder
    {
        return $builder->setId('notifications_settings')
            ->setMethod('post')
            ->setAction(route('settings.modules.notifications.store'))
            ->class('settings-form')
            ->add(FormComponent::hidden('module', 'notifications'))
            ->addSection(
                __('forms.settings.general.general'),
                fn (FormBuilder $builder) => $builder
                    ->add(FormComponent::switch('mail_notifications', $this->mail_notifications)->label(__('forms.settings.notifications.mail_notifications'))->info(__('forms.settings.notifications.info.mail_notifications'))->key(self::settingsKey('notifications.mail_notifications')))
                    ->add(FormComponent::switch('system_notifications', $this->system_notifications)->label(__('forms.settings.notifications.system_notifications'))->info(__('forms.settings.notifications.info.system_notifications'))->key(self::settingsKey('notifications.system_notifications')))
            )
            ->addSubmit();
    }

    public function validation(): array
    {
        return array(
            'mail_notifications' => 'boolean',
            'system_notifications' => 'boolean',
        );
    }
}
