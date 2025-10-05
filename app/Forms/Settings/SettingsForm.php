<?php

namespace App\Forms\Settings;

use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\FormBuilder;
use Illuminate\Http\Request;

trait SettingsForm
{
    protected static function settingsKey(string $settingsKey): ?string
    {
        return config('app.debug') ? $settingsKey : null;
    }
}
