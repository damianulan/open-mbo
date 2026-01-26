<?php

namespace App\Forms\Settings;

use App\Config\AppConfig;
use App\Enums\Core\ExportType;
use App\Forms\Traits\SettingsForm;
use App\Lib\Theme;
use App\Settings\GeneralSettings;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;

class GeneralForm extends Form
{
    use SettingsForm;

    public function definition(FormBuilder $builder): FormBuilder
    {
        return $builder->setId('general_settings')
            ->setMethod('post')
            ->setAction(route('settings.general.store'))
            ->class('settings-form')
            ->addSection(
                __('forms.settings.general.general'),
                fn (FormBuilder $builder) => $builder
                    ->add(FormComponent::text('site_name', $this->site_name)->label(__('forms.settings.general.site_name'))->key(self::settingsKey('general.site_name')))
                    ->add(FormComponent::select('theme', $this->theme, Dictionary::fromUnassocArray(Theme::getAvailable()->toArray()), app(GeneralSettings::class)->theme)
                        ->label(__('forms.settings.general.theme'))->noEmpty()->key(self::settingsKey('general.theme')))
                    ->add(FormComponent::select('locale', $this->locale, Dictionary::fromUnassocArray(config('app.available_locales'), 'globals.langs'), app(GeneralSettings::class)->locale)
                        ->label(__('forms.settings.general.lang'))->noEmpty()->key(self::settingsKey('general.lang')))
                    ->add(FormComponent::select('target_release', $this->target_release, Dictionary::fromAssocArray(AppConfig::getReleasesOptions()), app(GeneralSettings::class)->target_release)
                        ->label(__('forms.settings.general.release'))->key(self::settingsKey('general.release')))
            )
            ->addSection(
                __('forms.settings.general.datas'),
                fn (FormBuilder $builder) => $builder
                    ->add(FormComponent::multiselect('export_types', $this->export_types, Dictionary::fromEnum(ExportType::class))
                        ->label(__('forms.settings.general.export_types'))->key(self::settingsKey('general.export_types')))
            )
            ->addSubmit();
    }

    public function validation(): array
    {
        return [];
    }
}
