<?php

namespace App\Models\Business;

use App\Casts\FormattedText;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Warden\RolesLib;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;
use Sentinel\Models\Role;
use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string|null $leader_id
 * @property string $name
 * @property mixed|null $description
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read User|null $leader
 * @property-read Collection<int, User> $leaders
 * @property-read int|null $leaders_count
 * @property-read mixed $trans
 * @property-read Collection<int, User> $users
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
 * @method static \Database\Factories\Business\TeamFactory factory($count = null, $state = [])
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
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function leaders(): MorphToMany
    {
        return $this->morphToMany(User::class, 'context', 'has_roles', null, 'model_id')
            ->where('role_id', Role::getId(RolesLib::TEAM_LEADER));
    }

    public function refreshUsers(?array $usersIds): bool
    {
        if (is_null($usersIds)) {
            $usersIds = [];
        }

        $this->users()->sync($usersIds);

        return true;
    }

    public function refreshLeaderRoles(?array $leaderIds): bool
    {
        if (is_null($leaderIds)) {
            $leaderIds = [];
        }

        $current = $this->leaders->pluck('id')->toArray();
        $toDelete = array_values(array_diff($current, $leaderIds));
        $toAdd = array_values(array_diff($leaderIds, $current));
        $leaders = User::query()
            ->whereIn('id', array_merge($toDelete, $toAdd))
            ->get()
            ->keyBy('id');

        foreach ($toDelete as $leaderId) {
            $leader = $leaders->get($leaderId);
            if ($leader) {
                $leader->revokeRoleSlug(RolesLib::TEAM_LEADER, $this);
            }
        }

        foreach ($toAdd as $leaderId) {
            $leader = $leaders->get($leaderId);
            if ($leader) {
                $leader->assignRoleSlug(RolesLib::TEAM_LEADER, $this);
            }
        }

        return true;
    }

    public function revokeLeadersRoles(): bool
    {
        foreach ($this->leaders as $leader) {
            $leader->revokeRoleSlug(RolesLib::TEAM_LEADER, $this);
        }

        return true;
    }

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function (Team $team): void {
            $team->revokeLeadersRoles();
        });
    }
}
