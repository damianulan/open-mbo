<?php

namespace App\Support\Notifications\Models;

use App\Support\Notifications\NotificationContents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lucent\Support\Traits\UUID;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $id
 * @property string $key
 * @property array<array-key, mixed>|null $resources
 * @property mixed|null $contents
 * @property bool $system
 * @property bool $email
 * @property string|null $event
 * @property string|null $schedule
 * @property array<array-key, mixed>|null $conditions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereResources($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Notification extends Model
{
    use SoftDeletes, UUID;

    protected $table = 'notifications';

    protected $fillable = [
        'key',
        'resources',
        'contents',
        'system',
        'email',
        'event',
        'schedule',
        'conditions',
    ];

    protected $casts = [
        'resources' => 'array',
        'contents' => NotificationContents::class,
        'system' => 'boolean',
        'email' => 'boolean',
        'conditions' => 'array',
    ];

    public static function byKey(string $key): ?self
    {
        return self::where('notifications.key', $key)->first();
    }

    public static function createOrUpdate(string $key, array $attributes = []): self
    {
        $notification = self::byKey($key);
        if (! $notification) {
            $notification = new self;
            $attributes['key'] = $key;
        }
        $notification->fill($attributes);
        $notification->save();

        return $notification;
    }

    public function setContents(?string $system_contents, ?string $email_contents, ?string $subject): self
    {
        $this->contents = new NotificationContents($system_contents, $email_contents, $subject);

        return $this;
    }

    public function scopeEvents(Builder $query): void
    {
        $query->select('notifications.event')->groupBy('notifications.event');
    }

    public function scopeWhereEvent(Builder $query, string $event): void
    {
        $query->where('notifications.event', $event);
    }
}
