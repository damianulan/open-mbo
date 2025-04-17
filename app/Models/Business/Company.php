<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Facades\TrixField\TrixFieldCast;
use App\Models\Core\User;
use App\Models\Business\Location;

/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $shortname
 * @property mixed|null $description
 * @property string|null $logo
 * @property \Illuminate\Support\Carbon|null $founded
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\UserEmployment> $employments
 * @property-read int|null $employments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Location> $locations
 * @property-read int|null $locations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereShortname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withoutTrashed()
 * @method static \Database\Factories\Business\CompanyFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
class Company extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'name',
        'shortname',
        'description',
        'logo',
        'founded',
    ];

    protected $dates = [
        'founded',
        'created_at',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
        'founded' => 'date',
        'created_at' => 'datetime',
    ];

    public function employments()
    {
        return $this->hasMany(UserEmployment::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class,'companies_locations');
    }

}
