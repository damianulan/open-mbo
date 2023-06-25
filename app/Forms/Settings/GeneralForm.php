<?php

namespace App\Forms\Settings;

use App\Facades\Forms\FormBuilder;
use App\Facades\Forms\FormElement;
use App\Facades\Forms\Elements\Dictionary;
use App\Lib\Theme;
use App\Settings\GeneralSettings;
class GeneralForm
{
    public static function boot($model = null): FormBuilder
    {
        return (new FormBuilder('post', route('settings.general.store'), 'general_settings'))
                ->class('settings-form')
                ->add(FormElement::text('site_name', $model)->label(__('forms.settings.general.site_name')))
                ->add(FormElement::select('theme', $model, Dictionary::fromUnassocArray(Theme::getAvailable()), app(GeneralSettings::class)->theme)
                ->label(__('forms.settings.general.theme'))->noEmpty())

                ->addSubmit();
    }
}
