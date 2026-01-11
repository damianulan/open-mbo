<?php

namespace App\Forms\Settings;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Http\Request;
use App\Forms\Traits\SettingsForm;

class MboForm extends Form
{
    use SettingsForm;

    protected static ?string $backRoute = 'settings.modules.index';

    protected static array $backParams = array('module' => 'mbo');

    public function definition(FormBuilder $builder): FormBuilder
    {
        return $builder->setId('mbo_settings')
            ->setMethod('post')
            ->setAction(route('settings.modules.mbo.store'))
            ->class('settings-form')
            ->add(FormComponent::hidden('module', 'mbo'))
            ->addSection(__('forms.settings.general.general'), fn (FormBuilder $builder) => $builder
                ->add(FormComponent::switch('enabled', $this->model)->label(__('forms.settings.mbo.enabled'))->info(__('forms.settings.mbo.info.enabled'))->key(self::settingsKey('mbo.enabled'))))
            ->addSection(
                __('mbo.objectives.index'),
                fn (FormBuilder $builder) => $builder
                    ->add(FormComponent::switch('objectives_autofail', $this->model)->label(__('forms.settings.mbo.objectives_autofail'))->info(__('forms.settings.mbo.info.objectives_autofail'))->key(self::settingsKey('mbo.objectives_autofail')))
                    ->add(FormComponent::switch('objectives_self_final_evaluation', $this->model)->label(__('forms.settings.mbo.objectives_self_final_evaluation'))->key(self::settingsKey('mbo.objectives_self_final_evaluation')))
                    ->add(FormComponent::switch('objectives_weights', $this->model)->label(__('forms.settings.mbo.objectives_weights'))->info(__('forms.settings.mbo.info.objectives_weights_autofail'))->key(self::settingsKey('mbo.objectives_weights')))
            )
            ->addSection(__('mbo.campaigns_full'), fn (FormBuilder $builder) => $builder
                ->add(FormComponent::switch('campaigns_enabled', $this->model)->label(__('forms.settings.mbo.campaigns_enabled'))->info(__('forms.settings.mbo.info.campaigns_enabled'))->key(self::settingsKey('mbo.campaigns_enabled')))
                ->add(FormComponent::switch('campaigns_ignore_dates', $this->model)->label(__('forms.settings.mbo.campaigns_ignore_dates'))->info(__('forms.settings.mbo.info.campaigns_ignore_dates'))->key(self::settingsKey('mbo.campaigns_ignore_dates')))
                ->add(FormComponent::switch('campaigns_manual', $this->model)->label(__('forms.settings.mbo.campaigns_manual'))->info(__('forms.settings.mbo.info.campaigns_manual'))->key(self::settingsKey('mbo.campaigns_manual')))
                ->add(FormComponent::decimal('campaigns_bonus', $this->model)->label(__('forms.settings.mbo.campaigns_bonus'))->info(__('forms.settings.mbo.info.campaigns_bonus'))->key(self::settingsKey('mbo.campaigns_bonus'))))
            ->addSection(__('mbo.rewards'), fn (FormBuilder $builder) => $builder
                ->add(FormComponent::switch('rewards', $this->model)->label(__('forms.settings.mbo.rewards'))->info(__('forms.settings.mbo.info.rewards'))->key(self::settingsKey('mbo.rewards')))
                ->add(FormComponent::switch('rewards_proportional', $this->model)->label(__('forms.settings.mbo.rewards_proportional'))->info(__('forms.settings.mbo.info.rewards_proportional'))->key(self::settingsKey('mbo.rewards_proportional')))
                ->add(FormComponent::switch('manipulate_rewards', $this->model)->label(__('forms.settings.mbo.manipulate_rewards'))->info(__('forms.settings.mbo.info.manipulate_rewards'))->key(self::settingsKey('mbo.manipulate_rewards')))
                ->add(FormComponent::switch('failed_rewards', $this->model)->label(__('forms.settings.mbo.failed_rewards'))->info(__('forms.settings.mbo.info.failed_rewards'))->key(self::settingsKey('mbo.failed_rewards')))
                ->add(FormComponent::decimal('rewards_min_evaluation', $this->model)->label(__('forms.settings.mbo.rewards_min_evaluation'))->info(__('forms.settings.mbo.info.rewards_min_evaluation'))->key(self::settingsKey('mbo.rewards_min_evaluation')))
                ->add(FormComponent::decimal('rewards_points_exchange', $this->model)->label(__('forms.settings.mbo.rewards_points_exchange'))->info(__('forms.settings.mbo.info.rewards_points_exchange'))->key(self::settingsKey('mbo.rewards_points_exchange')))
                ->add(FormComponent::text('rewards_currency', $this->model)->label(__('forms.settings.mbo.rewards_currency'))->info(__('forms.settings.mbo.info.rewards_currency'))->key(self::settingsKey('mbo.rewards_currency'))))
            ->addSubmit();
    }

    public function validation(): array
    {
        return array(
            'enabled' => 'boolean',
            'campaigns_enabled' => 'boolean',
            'campaigns_manual' => 'boolean',
            'objectives_autofail' => 'boolean',
            'objectives_self_final_evaluation' => 'boolean',
            'objectives_weights' => 'boolean',
            'rewards' => 'boolean',
            'rewards_proportional' => 'boolean',
            'manipulate_rewards' => 'boolean',
            'failed_rewards' => 'boolean',
            'rewards_currency' => 'required|string|max:3',
        );
    }
}
