<?php

namespace App\Models\Business;

use App\Casts\FormattedText;
use App\Models\BaseModel;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string $leader_id
 * @property string $name
 * @property mixed|null $description
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read User $leader
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\Team onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team whereLeaderId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\Team withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\Team withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\Team withoutTrashed()
 *
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
        return $this->belongsTo(User::class, 'leader_id');
    }
}
