<?php

namespace App\Support\Notifications\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $notification_id
 * @property string $notifiable_type
 * @property string $notifiable_id
 * @property Collection $resources
 * @property string $subject
 * @property string $contents
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification whereNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification whereResources($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\Notifications\Models\MailNotification whereUpdatedAt($value)
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
