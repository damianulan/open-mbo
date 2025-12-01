<?php

namespace App\Forms\Settings;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Http\Request;
use App\Forms\Traits\SettingsForm;
use Illuminate\Validation\Rules\File;

class BrandingForm extends Form
{
    use SettingsForm;

    public static function definition(Request $request, $model = null): FormBuilder
    {
        return FormBuilder::boot($request, 'post', route('settings.branding.store'), 'branding_settings')
            ->class('settings-form')
            ->add(FormComponent::file('site_logo', $model)
                ->label(__('forms.settings.general.site_logo'))->key(self::settingsKey('general.site_logo')))
            ->addSubmit();
    }

    public static function validation(Request $request, $model_id = null): array
    {
        return [
            'site_logo' => [
                'nullable',
                'image',
                File::types(['png', 'jpg', 'jpeg', 'svg'])
                    ->max('2mb')
            ],
        ];
    }
}
