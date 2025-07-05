<?php

namespace App\Forms\Settings;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Http\Request;

class MboForm extends Form
{
    protected static ?string $backRoute = 'settings.modules.index';

    protected static array $backParams = ['module' => 'mbo'];

    public static function definition(Request $request, $model = null): FormBuilder
    {
        return FormBuilder::boot($request, 'post', route('settings.modules.mbo.store'), 'mbo_settings')
            ->class('settings-form')
            ->add(FormComponent::hidden('module', 'mbo'))
            ->add(FormComponent::switch('enabled', $model)->label(__('forms.settings.mbo.enabled'))->info(__('forms.settings.mbo.info.enabled')))
            ->add(FormComponent::switch('campaigns_enabled', $model)->label(__('forms.settings.mbo.campaigns_enabled'))->info(__('forms.settings.mbo.info.campaigns_enabled')))
            ->add(FormComponent::switch('campaigns_manual', $model)->label(__('forms.settings.mbo.campaigns_manual'))->info(__('forms.settings.mbo.info.campaigns_manual')))
            ->add(FormComponent::switch('rewards', $model)->label(__('forms.settings.mbo.rewards'))->info(__('forms.settings.mbo.info.rewards')))
            ->add(FormComponent::decimal('reward_points_exchange', $model)->label(__('forms.settings.mbo.reward_points_exchange'))->info(__('forms.settings.mbo.info.reward_points_exchange')))
            ->add(FormComponent::text('reward_currency', $model)->label(__('forms.settings.mbo.reward_currency'))->info(__('forms.settings.mbo.info.reward_currency')))

            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [
            'enabled' => 'boolean',
            'campaigns_enabled' => 'boolean',
            'campaigns_manual' => 'boolean',
            'rewards' => 'boolean',
        ];
    }
}
