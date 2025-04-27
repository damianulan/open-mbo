<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use FormForge\Casts\TrixFieldCast;
use App\Models\Core\User;
use App\Models\Business\Company;

/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $city
 * @property string|null $postal_code
 * @property mixed|null $description
 * @property bool $active
 * @property string|null $founded
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Company> $companies
 * @property-read int|null $companies_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location withoutTrashed()
 * @method static \Database\Factories\Business\LocationFactory factory($count = null, $state = [])
 * @property string|null $country
 * @mixin \Eloquent
 */
class Location extends BaseModel
{
    protected $fillable = [
        'name',
        'address_line_1',
        'address_line_2',
        'city',
        'country',
        'postal_code',
        'description',
        'active',
    ];

    protected $dates = [
        'created_at',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
        'created_at' => 'datetime',
        'active' => 'boolean',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'companies_locations');
    }
}
