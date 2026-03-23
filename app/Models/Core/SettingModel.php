<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $group
 * @property string $name
 * @property bool $locked
 * @property string $payload
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingModel whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingModel whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingModel wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SettingModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
