<?php

namespace App\Forms\Settings;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Http\Request;
use App\Forms\Traits\SettingsForm;

class UsersForm extends Form
{
    use SettingsForm;

    protected static ?string $backRoute = 'settings.modules.index';

    protected static array $backParams = array('module' => 'users');

    public function definition(FormBuilder $builder): FormBuilder
    {
        return $builder->setId('users_settings')
            ->setMethod('post')
            ->setAction(route('settings.modules.users.store'))
            ->class('settings-form')
            ->add(FormComponent::hidden('module', 'users'))
            ->addSection(__('forms.settings.general.auth'), fn (FormBuilder $builder) => $builder
                ->add(FormComponent::switch('password_change_firstlogin', $this->password_change_firstlogin)->label(__('forms.settings.users.password_change_firstlogin'))->info(__('forms.settings.users.info.password_change_firstlogin'))->key(self::settingsKey('users.password_change_firstlogin')))
                ->add(FormComponent::switch('force_password_change_reset', $this->force_password_change_reset)->label(__('forms.settings.users.force_password_change_reset'))->info(__('forms.settings.users.info.force_password_change_reset'))->key(self::settingsKey('users.force_password_change_reset')))
            )
            ->addSection(__('forms.employments.index'), fn (FormBuilder $builder) => $builder
                ->add(FormComponent::switch('multiple_employments', $this->multiple_employments)->label(__('forms.settings.users.multiple_employments'))->info(__('forms.settings.users.info.multiple_employments'))->key(self::settingsKey('users.multiple_employments')))
            )
            ->addSubmit();
    }

    public function validation(): array
    {
        return array(
            'password_change_firstlogin' => 'boolean',
            'force_password_change_reset' => 'boolean',
            'multiple_employments' => 'boolean',
        );
    }
}
