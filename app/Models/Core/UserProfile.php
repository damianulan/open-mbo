<?php

namespace App\Models\Core;

use App\Traits\HasEnigmaAttributes;
use FormForge\Traits\RequestForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $user_id
 * @property string|null $birthday
 * @property mixed|null $phone
 * @property string|null $avatar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property mixed $nin
 * @property mixed $gender
 * @property-read User $user
 *
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
 *
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
