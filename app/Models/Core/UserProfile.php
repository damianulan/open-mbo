<?php

namespace App\Models\Core;

use App\Traits\HasEnigmaAttributes;
use Carbon\CarbonImmutable;
use FormForge\Traits\RequestForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $birthday
 * @property string|null $phone
 * @property string|null $avatar
 * @property CarbonImmutable|null $created_at
 * @property CarbonImmutable|null $updated_at
 * @property CarbonImmutable|null $deleted_at
 * @property-read User|null $user
 * @method static \Database\Factories\Core\UserProfileFactory factory($count = null, $state = [])
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile newModelQuery()
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile onlyTrashed()
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile query()
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile whereAvatar($value)
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile whereBirthday($value)
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile whereCreatedAt($value)
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile whereDeletedAt($value)
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile whereId($value)
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile wherePhone($value)
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile whereUpdatedAt($value)
 * @method static \App\Builders\Eloquent\EnigmaBuilder<static>|UserProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile withoutTrashed()
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    use HasEnigmaAttributes;
    use HasFactory;
    use RequestForms;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nin',
        'gender',
        'birthday',
        'phone',
        'avatar',
    ];

    protected $dates = [
        'birthday',
    ];

    protected $encrypted = [
        'nin',
        'gender',
        'phone',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
