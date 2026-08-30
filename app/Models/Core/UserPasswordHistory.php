<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Models\Core\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory query()
 * @mixin \Eloquent
 */
class UserPasswordHistory extends Model
{
    protected $table = 'user_password_history';

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'password',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
