<?php

namespace App\Models\Core;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $password
 * @property CarbonImmutable|null $created_at
 * @property CarbonImmutable|null $updated_at
 * @property-read \App\Models\Core\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPasswordHistory whereUserId($value)
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
