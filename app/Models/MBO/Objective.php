<?php

namespace App\Models\MBO;

use App\Casts\Carbon\CarbonDatetime;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\Scopes\MBO\ObjectiveScope;
use FormForge\Casts\TrixFieldCast;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Lucent\Support\Traits\Dispatcher;

/**
 * @property string $id
 * @property string|null $template_id
 * @property string|null $parent_id
 * @property string|null $campaign_id
 * @property string $name
 * @property mixed|null $description
 * @property mixed|null $deadline
 * @property string $weight
 * @property string|null $award
 * @property string|null $expected
 * @property mixed $draft
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Campaign|null $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Objective> $children
 * @property-read int|null $children_count
 * @property-read Objective|null $parent
 * @property-read ObjectiveTemplate|null $template
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserObjective> $user_assignments
 * @property-read int|null $user_assignments_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereAward($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereExpected($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective checkAccess()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective drafted()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective published()
 * @method static Builder<static>|Objective whereAssigned(\App\Models\Core\User $user)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective withoutCache()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective prunableSoftDeletes()
 *
 * @mixin \Eloquent
 */
class Objective extends BaseModel
{
    use Dispatcher;

    protected $fillable = [
        'template_id',
        'campaign_id',
        'name',
        'description',
        'deadline',
        'weight',
        'draft',
        'award',
        'expected',
    ];

    protected $casts = [
        'draft' => 'boolean',
        'deadline' => CarbonDatetime::class,
        'description' => TrixFieldCast::class,
    ];

    protected $accessScope = ObjectiveScope::class;

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            if ($model->campaign_id) {
                $ucs = $model->campaign->user_campaigns;
                if ($ucs) {
                    foreach ($ucs as $uc) {
                        UserObjective::assign($uc->user_id, $model->id);
                    }
                }
            }
        });
    }

    public function isOverdued(): bool
    {
        if ($this->deadline) {
            $deadline = \Carbon\Carbon::parse($this->deadline);
            if ($deadline->isPast()) {
                return true;
            }
        }

        return false;
    }

    public function template()
    {
        return $this->belongsTo(ObjectiveTemplate::class, 'template_id');
    }

    public function category()
    {
        return $this->template?->category();
    }

    public function coordinators()
    {
        return $this->template?->coordinators();
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function type()
    {
        return $this->template()->type;
    }

    public function user_assignments()
    {
        return $this->hasMany(UserObjective::class);
    }

    public function canBeDeleted(): bool
    {
        return $this->user_assignments()->count() ? false : true;
    }

    public function scopeWhereAssigned(Builder $query, User $user): void
    {
        $query->select('objectives.*')
            ->join('user_objectives', function (JoinClause $join) use ($user) {
                $join->on('objectives.id', '=', 'user_objectives.objective_id')
                    ->where('user_objectives.user_id', $user->id);
            })
            ->published();
    }

    public static function creatingObjective(Objective $model): self
    {
        if ($model->campaign_id && empty($model->deadline)) {
            $campaign = Campaign::find($model->campaign_id);
            if ($campaign) {
                $model->deadline = $campaign->realization_to;
            }
        }

        return $model;
    }
}
