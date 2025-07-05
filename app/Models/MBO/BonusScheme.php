<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use FormForge\Casts\TrixFieldCast;

/**
 * @property string $id
 * @property string $name
 * @property mixed|null $description
 * @property array $options
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MBO\UserBonusAssignment> $assignments
 * @property-read int|null $assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme withoutTrashed()
 *
 * @mixin \Eloquent
 */
class BonusScheme extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'options',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
        'options' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_bonus_schemes');
    }

    public function assignments()
    {
        return $this->hasMany(UserBonusAssignment::class);
    }
}
