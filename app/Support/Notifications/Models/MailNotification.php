<?php

namespace App\Support\Notifications\Models;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $notification_id
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property Collection $resources
 * @property string $subject
 * @property string $contents
 * @property CarbonImmutable|null $created_at
 * @property CarbonImmutable|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification whereResources($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MailNotification whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class MailNotification extends NotificationModel
{
    protected $table = 'mail_notifications';

    protected $fillable = [
        'notification_id',
        'notifiable_type',
        'notifiable_id',
        'resources',
        'subject',
        'contents',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
