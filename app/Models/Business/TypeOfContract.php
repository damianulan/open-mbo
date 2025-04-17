<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;

/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property mixed|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\UserEmployment> $employments
 * @property-read int|null $employments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract withoutTrashed()
 * @mixin \Eloquent
 */
class TypeOfContract extends BaseModel
{
    use TrixFields;

    public static $contracts = [
        'uop', 'uz', 'b2b', 'uod'
    ];

    protected $fillable = [
        'name',
        'shortname',
        'description',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
    ];

    public static function findByShortname($name)
    {
        return self::where('shortname', $name)->first();
    }

    public function employments()
    {
        return $this->hasMany(UserEmployment::class);
    }
}
