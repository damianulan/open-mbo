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
                ->add(FormComponent::numeric('password_min_length', $this->password_min_length)->label(__('forms.settings.users.password_min_length'))->info(__('forms.settings.users.info.password_min_length'))->key(self::settingsKey('users.password_min_length')))
                ->add(FormComponent::numeric('password_min_letters', $this->password_min_letters)->label(__('forms.settings.users.password_min_letters'))->info(__('forms.settings.users.info.password_min_letters'))->key(self::settingsKey('users.password_min_letters')))
                ->add(FormComponent::numeric('password_min_numbers', $this->password_min_numbers)->label(__('forms.settings.users.password_min_numbers'))->info(__('forms.settings.users.info.password_min_numbers'))->key(self::settingsKey('users.password_min_numbers')))
                ->add(FormComponent::numeric('password_min_symbols', $this->password_min_symbols)->label(__('forms.settings.users.password_min_symbols'))->info(__('forms.settings.users.info.password_min_symbols'))->key(self::settingsKey('users.password_min_symbols')))
                ->add(FormComponent::numeric('password_not_repeat', $this->password_not_repeat)->label(__('forms.settings.users.password_not_repeat'))->info(__('forms.settings.users.info.password_not_repeat'))->key(self::settingsKey('users.password_not_repeat')))

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
