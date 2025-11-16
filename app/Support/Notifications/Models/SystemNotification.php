<?php

namespace App\Support\Notifications\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $notification_id
 * @property string $notifiable_type
 * @property string $notifiable_id
 * @property \Illuminate\Support\Collection $resources
 * @property string $contents
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $notified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification whereNotifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification whereResources($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\SystemNotification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SystemNotification extends NotificationModel
{
    protected $table = 'system_notifications';

    protected $fillable = [
        'notification_id',
        'notifiable_type',
        'notifiable_id',
        'resources',
        'contents',
        'read_at',
        'notified_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'notified_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function unread()
    {
        return is_null($this->read_at);
    }
}
