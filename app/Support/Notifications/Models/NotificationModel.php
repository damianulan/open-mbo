<?php

namespace App\Support\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Lucent\Support\Traits\UUID;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel query()
 * @mixin \Eloquent
 */
class NotificationModel extends Model
{
    use UUID;


    protected function fillContent(string $content): string
    {
        return $content;
    }
}
