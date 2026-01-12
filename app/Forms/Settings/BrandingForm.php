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

    public function definition(FormBuilder $builder): FormBuilder
    {
        return $builder->setId('branding_settings')
            ->setMethod('post')
            ->setAction(route('settings.branding.store'))
            ->class('settings-form')
            ->add(FormComponent::file('site_logo', $this->site_logo)
                ->label(__('forms.settings.general.site_logo'))->key(self::settingsKey('general.site_logo')))
            ->addSubmit();
    }

    public function validation(): array
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
