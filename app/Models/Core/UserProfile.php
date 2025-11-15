<?php

namespace App\Models\Core;

use App\Casts\Enigma;
use FormForge\Traits\RequestForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $user_id
 * @property mixed $firstname
 * @property mixed $lastname
 * @property string|null $gender
 * @property string|null $birthday
 * @property mixed|null $phone
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Core\User $user
 *
 * @method static \Database\Factories\Core\UserProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile withoutTrashed()
 *
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    use HasFactory, RequestForms, SoftDeletes;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'gender',
        'birthday',
        'phone',
        'avatar',
    ];

    protected $dates = [
        'birthday',
    ];

    protected $casts = [
        'firstname' => Enigma::class,
        'lastname' => Enigma::class,
        'phone' => Enigma::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
