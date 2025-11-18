<?php

namespace App\Support\Notifications\Models;

use App\Support\Notifications\Factories\ResourceFactory;
use App\Support\Notifications\NotificationContents;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Lucent\Support\Traits\UUID;

/**
 * @property string $id
 * @property string $key
 * @property mixed|null $contents
 * @property bool $system
 * @property bool $email
 * @property string|null $event
 * @property string|null $schedule
 * @property array<array-key, mixed>|null $conditions
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection $resources
 *
 * @method static Builder<static>|Notification events()
 * @method static Builder<static>|Notification newModelQuery()
 * @method static Builder<static>|Notification newQuery()
 * @method static Builder<static>|Notification onlyTrashed()
 * @method static Builder<static>|Notification query()
 * @method static Builder<static>|Notification whereConditions($value)
 * @method static Builder<static>|Notification whereContents($value)
 * @method static Builder<static>|Notification whereCreatedAt($value)
 * @method static Builder<static>|Notification whereDeletedAt($value)
 * @method static Builder<static>|Notification whereEmail($value)
 * @method static Builder<static>|Notification whereEvent($value)
 * @method static Builder<static>|Notification whereId($value)
 * @method static Builder<static>|Notification whereKey($value)
 * @method static Builder<static>|Notification whereSchedule($value)
 * @method static Builder<static>|Notification whereSystem($value)
 * @method static Builder<static>|Notification whereUpdatedAt($value)
 * @method static Builder<static>|Notification withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|Notification withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Notification extends Model
{
    use SoftDeletes, UUID;

    protected $table = 'notifications';

    protected $fillable = [
        'key',
        'contents',
        'system',
        'email',
        'event',
        'schedule',
        'conditions',
    ];

    protected $casts = [
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
        if ( ! $notification) {
            $notification = new self();
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

    protected function resources(): Attribute
    {
        return Attribute::make(
            get: function (): Collection {
                $models = [];
                if ($this->event) {
                    $models = ResourceFactory::getEventResourceModels($this->event);
                }
                if ($notifiable = config('auth.providers.users.model')) {
                    $models[$notifiable] = new $notifiable();
                }
                $resources = array_map(fn ($model) => ResourceFactory::matchModel($model), $models);
                $resources = array_filter($resources, fn ($item) => ! is_null($item));

                return collect($resources);
            },
        );
    }
}
