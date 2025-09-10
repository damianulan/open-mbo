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
            ->add(FormComponent::decimal('campaigns_bonus', $model)->label(__('forms.settings.mbo.campaigns_bonus'))->info(__('forms.settings.mbo.info.campaigns_bonus')))
            ->add(FormComponent::switch('objectives_autofail', $model)->label(__('forms.settings.mbo.objectives_autofail'))->info(__('forms.settings.mbo.info.objectives_autofail')))
            ->add(FormComponent::switch('rewards', $model)->label(__('forms.settings.mbo.rewards'))->info(__('forms.settings.mbo.info.rewards')))
            ->add(FormComponent::switch('rewards_proportional', $model)->label(__('forms.settings.mbo.rewards_proportional'))->info(__('forms.settings.mbo.info.rewards_proportional')))
            ->add(FormComponent::switch('manipulate_rewards', $model)->label(__('forms.settings.mbo.manipulate_rewards'))->info(__('forms.settings.mbo.info.manipulate_rewards')))
            ->add(FormComponent::switch('failed_rewards', $model)->label(__('forms.settings.mbo.failed_rewards'))->info(__('forms.settings.mbo.info.failed_rewards')))
            ->add(FormComponent::decimal('rewards_min_evaluation', $model)->label(__('forms.settings.mbo.rewards_min_evaluation'))->info(__('forms.settings.mbo.info.rewards_min_evaluation')))
            ->add(FormComponent::decimal('rewards_points_exchange', $model)->label(__('forms.settings.mbo.rewards_points_exchange'))->info(__('forms.settings.mbo.info.rewards_points_exchange')))
            ->add(FormComponent::text('rewards_currency', $model)->label(__('forms.settings.mbo.rewards_currency'))->info(__('forms.settings.mbo.info.rewards_currency')))

            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [
            'enabled' => 'boolean',
            'campaigns_enabled' => 'boolean',
            'campaigns_manual' => 'boolean',
            'objectives_autofail' => 'boolean',
            'rewards' => 'boolean',
            'rewards_proportional' => 'boolean',
            'manipulate_rewards' => 'boolean',
            'failed_rewards' => 'boolean',
            'rewards_currency' => 'required|string|max:3',
        ];
    }
}
