<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;

/**
 * @property string $id
 * @property string $user_id
 * @property string $bonus_scheme_id
 * @property string $campaign_id
 * @property int $score
 * @property User $approved_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\MBO\BonusScheme $bonus_scheme
 * @property-read \App\Models\MBO\Campaign $campaign
 * @property-read User $user
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment whereApprovedBy($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment whereBonusSchemeId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment whereCampaignId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment whereScore($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserBonusAssignment withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment withoutTrashed()
 *
 * @mixin \Eloquent
 */
class UserBonusAssignment extends BaseModel
{
    protected $fillable = [
        'user_id',
        'bonus_scheme_id',
        'campaign_id',
        'score',
        'approved_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function bonus_scheme()
    {
        return $this->belongsTo(BonusScheme::class);
    }
}
