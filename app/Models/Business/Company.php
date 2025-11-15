<?php

namespace App\Models\Business;

use App\Casts\FormattedText;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $shortname
 * @property mixed|null $description
 * @property string|null $logo
 * @property string|null $taxpayerid
 * @property \Illuminate\Support\Carbon|null $founded_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\UserEmployment> $employments
 * @property-read int|null $employments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\Location> $locations
 * @property-read int|null $locations_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company drafted()
 * @method static \Database\Factories\Business\CompanyFactory factory($count = null, $state = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company whereFoundedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company whereLogo($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company whereShortname($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company whereTaxpayerid($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Company withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Company extends BaseModel
{
    protected $fillable = [
        'name',
        'shortname',
        'description',
        'logo',
        'taxpayerid',
        'founded_at',
    ];

    protected $dates = [
        'founded_at',
        'created_at',
    ];

    protected $casts = [
        'description' => FormattedText::class,
        'founded_at' => 'date',
        'created_at' => 'datetime',
    ];

    public function employments(): HasMany
    {
        return $this->hasMany(UserEmployment::class);
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'companies_locations');
    }
}
