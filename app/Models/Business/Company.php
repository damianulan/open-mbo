<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use FormForge\Casts\TrixFieldCast;

/**
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company checkAccess()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company drafted()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company withoutCache()
 * @mixin \Eloquent
 */
class Company extends BaseModel
{
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
        return $this->belongsToMany(Location::class, 'companies_locations');
    }
}
