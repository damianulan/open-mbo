<?php

namespace App\Models\MBO;

use App\Casts\FormattedText;
use App\Models\BaseModel;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property string $id
 * @property string $name
 * @property mixed|null $description
 * @property array<array-key, mixed> $options
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MBO\UserBonusScheme> $user_schemes
 * @property-read int|null $user_schemes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme whereOptions($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BonusScheme withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme withoutTrashed()
 *
 * @mixin \Eloquent
 */
class BonusScheme extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'options',
    ];

    protected $casts = [
        'description' => FormattedText::class,
        'options' => 'collection',
    ];

    public function user_schemes(): HasMany
    {
        return $this->hasMany(UserBonusScheme::class);
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, UserBonusScheme::class);
    }
}
