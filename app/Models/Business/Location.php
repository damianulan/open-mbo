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
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Collection<int, \App\Models\Business\Company> $companies
 * @property-read int|null $companies_count
 * @property-read mixed $trans
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location drafted()
 * @method static \Database\Factories\Business\LocationFactory factory($count = null, $state = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereActive($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereAddressLine1($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereAddressLine2($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereCity($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereCountry($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereFounded($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location wherePostalCode($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Location withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location withoutTrashed()
 * @mixin \Eloquent
 */
class Location extends BaseModel
{
    protected $fillable = array(
        'name',
        'address_line_1',
        'address_line_2',
        'city',
        'country',
        'postal_code',
        'description',
        'active',
    );

    protected $dates = array(
        'created_at',
    );

    protected $casts = array(
        'created_at' => 'datetime',
        'active' => 'boolean',
    );

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'companies_locations');
    }
}
