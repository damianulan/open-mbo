<?php

namespace App\Models\Business;

use App\Casts\FormattedText;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
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
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position drafted()
 * @method static \Database\Factories\Business\PositionFactory factory($count = null, $state = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Position withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position withoutTrashed()
 * @mixin \Eloquent
 */
class Position extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'description' => FormattedText::class,
    ];

    public function employments(): HasMany
    {
        return $this->hasMany(UserEmployment::class);
    }
}
