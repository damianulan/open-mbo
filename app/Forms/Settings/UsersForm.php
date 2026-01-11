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
                ->add(FormComponent::switch('password_change_firstlogin', $this->model)->label(__('forms.settings.users.password_change_firstlogin'))->info(__('forms.settings.users.info.password_change_firstlogin'))->key(self::settingsKey('users.password_change_firstlogin'))))
            ->addSection(
                __('forms.employments.index'),
                fn (FormBuilder $builder) => $builder
                    ->add(FormComponent::switch('multiple_employments', $this->model)->label(__('forms.settings.users.multiple_employments'))->info(__('forms.settings.users.info.multiple_employments'))->key(self::settingsKey('users.multiple_employments')))
            )
            ->addSubmit();
    }

    public function validation(): array
    {
        return array(
            'password_change_firstlogin' => 'boolean',
            'multiple_employments' => 'boolean',
        );
    }
}
