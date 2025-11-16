<?php

namespace App\Models\Business;

use App\Casts\FormattedText;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

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
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position drafted()
 * @method static \Database\Factories\Business\PositionFactory factory($count = null, $state = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\Position onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\Position withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Position withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\Position withoutTrashed()
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
