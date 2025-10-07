<?php

namespace App\Models\MBO;

use App\Casts\FormattedText;
use App\Commentable\Support\Commentable;
use App\Contracts\MBO\HasDeadline;
use App\Events\MBO\Objectives\ObjectiveCreated;
use App\Events\MBO\Objectives\ObjectiveUpdated;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\Scopes\MBO\ObjectiveScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Lucent\Support\Traits\Dispatcher;

/**
 * @property string $id
 * @property string|null $template_id
 * @property string|null $campaign_id
 * @property string $name
 * @property mixed|null $description
 * @property \Illuminate\Support\Carbon|null $deadline Deadline for objective completion, to which realization should be approved, otherwise it turns out red.
 * @property string $weight Corresponds to the importance of the objective, the higher the weight, the more important it is.
 * @property string|null $award Max points to be awarded for objective completion
 * @property string|null $expected Expected numerical value of objective realization, that corresponds to 100% evaluation
 * @property bool $draft Is not visible to realization - only previewable to admins
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\MBO\Campaign|null $campaign
 * @property-read \App\Models\MBO\ObjectiveTemplateCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Commentable\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\MBO\ObjectiveTemplate|null $template
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MBO\UserObjective> $user_objectives
 * @property-read int|null $user_objectives_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective newQuery()
 * @method static Builder<static>|Objective onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereAssigned(\App\Models\Core\User $user)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereAward($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereCampaignId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereDeadline($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereDraft($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereExpected($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereTemplateId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective whereWeight($value)
 * @method static Builder<static>|Objective withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Objective withoutCache()
 * @method static Builder<static>|Objective withoutTrashed()
 *
 * @mixin \Eloquent
 */
#[ScopedBy(ObjectiveScope::class)]
class Objective extends BaseModel implements HasDeadline
{
    use Commentable, Dispatcher;

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
        'description' => FormattedText::class,
        'draft' => 'boolean',
        'deadline' => 'datetime',
    ];

    protected $cascadeDelete = [
        'user_objectives',
    ];

    protected $dispatchesEvents = [
        'updated' => ObjectiveUpdated::class,
        'created' => ObjectiveCreated::class,
    ];

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
            if ($this->deadline->isPast()) {
                return true;
            }
        }

        return false;
    }

    public function isAfterDeadline(): bool
    {
        return is_null($this->deadline) || ($this->deadline && $this->deadline->isPast());
    }

    /**
     * Is deadline is briefly upcoming.
     */
    public function isDeadlineUpcoming(int $days = 3): bool
    {
        if ($this->deadline) {
            if ($this->deadline->subDays($days)->isPast()) {
                return true;
            }
        }

        return false;
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(ObjectiveTemplate::class, 'template_id');
    }

    public function category(): HasOneThrough
    {
        return $this->hasOneThrough(ObjectiveTemplateCategory::class, ObjectiveTemplate::class, 'category_id', 'id', 'id', 'category_id');
    }

    public function coordinators()
    {
        return $this->template?->coordinators();
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function type()
    {
        return $this->template()->type;
    }

    public function user_objectives(): HasMany
    {
        return $this->hasMany(UserObjective::class);
    }

    public function canBeDeleted(): bool
    {
        return $this->user_objectives()->count() ? false : true;
    }

    public function scopeWhereAssigned(Builder $query, User $user): void
    {
        $query->whereHas('user_objectives', function (Builder $q) use ($user) {
            $q->where('user_id', $user->id);
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
