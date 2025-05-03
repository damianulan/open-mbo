<?php

namespace App\Forms\Settings;

use FormForge\Base\Form;
use Illuminate\Http\Request;
use FormForge\FormBuilder;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use App\Lib\Theme;
use App\Settings\GeneralSettings;

class GeneralForm extends Form
{
    public static function definition(Request $request, $model = null): FormBuilder
    {
        return FormBuilder::boot($request, 'post', route('settings.general.store'), 'general_settings')
            ->class('settings-form')
            ->add(FormComponent::text('site_name', $model)->label(__('forms.settings.general.site_name')))
            ->add(FormComponent::select('theme', $model, Dictionary::fromUnassocArray(Theme::getAvailable()->toArray()), app(GeneralSettings::class)->theme)
                ->label(__('forms.settings.general.theme'))->noEmpty())
            ->add(FormComponent::select('locale', $model, Dictionary::fromUnassocArray(config('app.available_locales'), 'globals.langs'), app(GeneralSettings::class)->locale)
                ->label(__('forms.settings.general.lang'))->noEmpty())

            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [];
    }
}
