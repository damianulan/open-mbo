<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $user_id
 * @property string $bonus_scheme_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\MBO\BonusScheme $bonus_scheme
 * @property-read User $user
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusScheme onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme whereBonusSchemeId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusScheme withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusScheme withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusScheme withoutTrashed()
 * @mixin \Eloquent
 */
class UserBonusScheme extends BaseModel
{
    protected $fillable = [
        'user_id',
        'bonus_scheme_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bonus_scheme(): BelongsTo
    {
        return $this->belongsTo(BonusScheme::class);
    }
}
