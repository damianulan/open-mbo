<?php

namespace App\Models\Business;

use App\Casts\FormattedText;
use App\Models\BaseModel;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string $leader_id
 * @property string $name
 * @property mixed|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read User $leader
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team whereLeaderId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Team withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team withoutTrashed()
 * @mixin \Eloquent
 */
class Team extends BaseModel
{
    protected $fillable = [
        'leader_id',
        'name',
        'description',
    ];

    protected $casts = [
        'description' => FormattedText::class,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_teams');
    }

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id')->withTrashed();
    }
}
