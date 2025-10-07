<?php

namespace App\Forms\Settings;

trait SettingsForm
{
    protected static function settingsKey(string $settingsKey): ?string
    {
        return config('app.debug') ? $settingsKey : null;
    }
}
