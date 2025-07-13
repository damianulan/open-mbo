<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Core\Role;
use App\Models\Core\User;
use FormForge\Casts\TrixFieldCast;

/**
 * @property string $id
 * @property string|null $parent_id
 * @property string $manager_id
 * @property string $name
 * @property mixed|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Department> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserEmployment> $employments
 * @property-read int|null $employments_count
 * @property-read User $manager
 * @property-read Department|null $parent
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department withoutTrashed()
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $managers
 * @property-read int|null $managers_count
 * @property string $shortname
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department checkAccess()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department drafted()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereShortname($value)
 *
 * @mixin \Eloquent
 */
class Department extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function managers()
    {
        return $this->morphToMany(User::class, 'context', 'has_roles', null, 'model_id')->where('role_id', Role::getId('supervisor'));
    }

    public function employments()
    {
        return $this->hasMany(UserEmployment::class);
    }
}
