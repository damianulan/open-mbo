<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string $name
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $city
 * @property string|null $country
 * @property string|null $postal_code
 * @property string|null $description
 * @property bool $active
 * @property string|null $founded
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\Company> $companies
 * @property-read int|null $companies_count
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location drafted()
 * @method static \Database\Factories\Business\LocationFactory factory($count = null, $state = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\Location onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereActive($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereAddressLine1($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereAddressLine2($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereCity($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereCountry($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereFounded($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location wherePostalCode($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\Location withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Location withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\Location withoutTrashed()
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
        'created_at' => 'datetime',
        'active' => 'boolean',
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'companies_locations');
    }
}
