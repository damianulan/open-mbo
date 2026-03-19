<?php

namespace App\Forms\Users;

use App\Support\UI\Theme\Theme;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Validation\Rule;

class ProfilePreferencesForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $preferences = $this->model?->preferences;
        $availableThemes = array_merge(['auto'], Theme::getAvailable()->toArray());
        $availableLocales = array_values(array_unique(array_merge(['auto'], config('app.available_locales', []))));

        return $builder->setId('profile_preferences')
            ->setMethod('POST')
            ->setAction(route('preferences.update'))
            ->class('profile-preferences-form')
            ->add(FormComponent::select('lang', $preferences, Dictionary::fromUnassocArray($availableLocales, 'globals.langs'))
                ->label(__('forms.profile.preferences.lang'))->noEmpty())
            ->add(FormComponent::select('theme', $preferences, Dictionary::fromUnassocArray($availableThemes))
                ->label(__('forms.profile.preferences.theme'))->noEmpty())
            ->add(FormComponent::switch('mail_notifications', $preferences)
                ->label(__('forms.profile.preferences.mail_notifications')))
            ->add(FormComponent::switch('app_notifications', $preferences)
                ->label(__('forms.profile.preferences.app_notifications')))
            ->add(FormComponent::switch('extended_notifications', $preferences)
                ->label(__('forms.profile.preferences.extended_notifications')))
            ->add(FormComponent::switch('system_notifications', $preferences)
                ->label(__('forms.profile.preferences.system_notifications')))
            ->addSubmit();
    }

    public function validation(): array
    {
        $availableThemes = array_merge(['auto'], Theme::getAvailable()->toArray());
        $availableLocales = array_values(array_unique(array_merge(['auto'], config('app.available_locales', []))));

        return [
            'lang' => ['required', 'string', Rule::in($availableLocales)],
            'theme' => ['required', 'string', Rule::in($availableThemes)],
            'mail_notifications' => 'boolean',
            'app_notifications' => 'boolean',
            'extended_notifications' => 'boolean',
            'system_notifications' => 'boolean',
        ];
    }
}
