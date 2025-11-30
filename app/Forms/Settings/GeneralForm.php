<?php

namespace App\Forms\Settings;

use App\Config\AppConfig;
use App\Enums\Core\ExportType;
use App\Lib\Theme;
use App\Settings\GeneralSettings;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Http\Request;

class GeneralForm extends Form
{
    use SettingsForm;

    public static function definition(Request $request, $model = null): FormBuilder
    {
        return FormBuilder::boot($request, 'post', route('settings.general.store'), 'general_settings')
            ->class('settings-form')
            ->addSection(__('forms.settings.general.general'), fn (FormBuilder $builder) => $builder
                ->add(FormComponent::text('site_name', $model)->label(__('forms.settings.general.site_name'))->key(self::settingsKey('general.site_name')))
                ->add(FormComponent::select('theme', $model, Dictionary::fromUnassocArray(Theme::getAvailable()->toArray()), app(GeneralSettings::class)->theme)
                    ->label(__('forms.settings.general.theme'))->noEmpty()->key(self::settingsKey('general.theme')))
                ->add(FormComponent::select('locale', $model, Dictionary::fromUnassocArray(config('app.available_locales'), 'globals.langs'), app(GeneralSettings::class)->locale)
                    ->label(__('forms.settings.general.lang'))->noEmpty()->key(self::settingsKey('general.lang')))
                ->add(FormComponent::select('target_release', $model, Dictionary::fromAssocArray(AppConfig::getReleasesOptions()), app(GeneralSettings::class)->target_release)
                    ->label(__('forms.settings.general.release'))->key(self::settingsKey('general.release')))
            )
            ->addSection(__('forms.settings.general.datas'), fn (FormBuilder $builder) => $builder
                ->add(FormComponent::select('gender', $model, Dictionary::fromEnum(ExportType::class))
                    ->label(__('forms.users.gender')))
            )
            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return array();
    }
}
