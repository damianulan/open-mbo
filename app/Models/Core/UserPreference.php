<?php

namespace App\Models\Core;

use FormForge\Traits\RequestForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $user_id
 * @property string $lang
 * @property string $theme
 * @property bool $mail_notifications
 * @property bool $app_notifications
 * @property bool $extended_notifications
 * @property bool $system_notifications
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Core\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereAppNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereExtendedNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereMailNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereSystemNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Core\UserPreference withoutTrashed()
 * @mixin \Eloquent
 */
class UserPreference extends Model
{
    use HasFactory, RequestForms, SoftDeletes;

    protected $table = 'user_preferences';

    protected $fillable = array(
        'user_id',
        'lang',
        'theme',
        'mail_notifications',
        'app_notifications',
        'extended_notifications',
        'system_notifications',
    );

    protected $attributes = array(
        'lang' => 'auto',
        'theme' => 'auto',
        'mail_notifications' => 1,
        'app_notifications' => 1,
        'extended_notifications' => 1,
        'system_notifications' => 1,
    );

    protected $casts = array(
        'mail_notifications' => 'boolean',
        'app_notifications' => 'boolean',
        'extended_notifications' => 'boolean',
        'system_notifications' => 'boolean',
    );

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
