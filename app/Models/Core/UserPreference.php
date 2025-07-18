<?php

namespace App\Models\Core;

use FormForge\Traits\RequestForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $user_id
 * @property string $lang
 * @property string $theme
 * @property bool $mail_notifications
 * @property bool $app_notifications
 * @property bool $extended_notifications
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference withoutTrashed()
 *
 * @property bool $system_notifications
 *
 * @mixin \Eloquent
 */
class UserPreference extends Model
{
    use HasFactory, RequestForms, SoftDeletes;

    protected $table = 'user_preferences';

    protected $fillable = [
        'lang',
        'theme',
        'mail_notifications',
        'app_notifications',
        'extended_notifications',
        'system_notifications',
    ];

    protected $attributes = [
        'lang' => 'auto',
        'theme' => 'auto',
        'mail_notifications' => 1,
        'app_notifications' => 1,
        'extended_notifications' => 1,
        'system_notifications' => 1,
    ];

    protected $casts = [
        'mail_notifications' => 'boolean',
        'app_notifications' => 'boolean',
        'extended_notifications' => 'boolean',
        'system_notifications' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
