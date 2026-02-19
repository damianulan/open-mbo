<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    protected $table = 'settings';

    protected $guarded = [];

    protected $casts = [
        'locked' => 'boolean',
    ];

    public static function getInstance(string $property): self
    {
        [$group, $name] = explode('.', $property);

        $setting = self::query()
            ->where('group', $group)
            ->where('name', $name)
            ->first();

        return $setting ? $setting : null;
    }

    public static function get(string $property)
    {
        [$group, $name] = explode('.', $property);

        $setting = self::query()
            ->where('group', $group)
            ->where('name', $name)
            ->first('payload');

        return $setting ? json_decode($setting->getAttribute('payload')) : null;
    }
}
