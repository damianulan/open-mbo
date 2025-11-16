<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string $user_id
 * @property string $bonus_scheme_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read BonusScheme $bonus_scheme
 * @property-read User $user
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\UserBonusScheme onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme whereBonusSchemeId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\UserBonusScheme withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserBonusScheme withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\UserBonusScheme withoutTrashed()
 *
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
