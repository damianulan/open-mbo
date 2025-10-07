<?php

namespace App\Support\Notifications\Models;

use App\Support\Notifications\Models\NotificationModel;

/**
 * @property string $id
 * @property string $notification_id
 * @property string $notifiable_type
 * @property string $notifiable_id
 * @property string|null $resources
 * @property string $contents
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $notified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification whereNotifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification whereResources($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemNotification whereUpdatedAt($value)
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
}
