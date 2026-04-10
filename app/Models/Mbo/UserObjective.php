<?php

namespace App\Models\Mbo;

use App\Commentable\Models\Comment;
use App\Commentable\Support\Commentable;
use App\Contracts\Mbo\AssignsPoints;
use App\Contracts\Mbo\HasDeadline;
use App\Enums\Mbo\CampaignStage;
use App\Enums\Mbo\UserObjectiveStatus;
use App\Events\Mbo\Campaigns\CampaignUserObjectiveAssigned;
use App\Events\Mbo\Campaigns\CampaignUserObjectiveUnassigned;
use App\Events\Mbo\Objectives\UserObjectiveAssigned;
use App\Events\Mbo\Objectives\UserObjectiveFailed;
use App\Events\Mbo\Objectives\UserObjectivePassed;
use App\Events\Mbo\Objectives\UserObjectiveUnassigned;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Traits\Guards\Mbo\CanUserObjective;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;
use Lucent\Support\Traits\HasUniqueUuid;
use Spatie\Activitylog\Models\Activity;

/**
 * @property int $id
 * @property int $user_id
 * @property int $objective_id
 * @property string $status objective status
 * @property numeric|null $realization Numerical value of the realization of the objective - in relation to the expected value in objective
 * @property numeric|null $evaluation Percentage evaluation of the objective - if realization is set, evaluation is calculated automatically
 * @property CarbonImmutable|null $evaluated_at Time when most recent evaluation was made
 * @property int|null $evaluated_by Time when most recent evaluator has made any changes
 * @property numeric|null $self_realization Numerical value of the realization of the objective - in relation to the expected value in objective
 * @property numeric|null $self_evaluation Percentage evaluation of the objective - if realization is set, evaluation is calculated automatically
 * @property string|null $self_evaluated_at Time when most recent self evaluation was made
 * @property CarbonImmutable|null $created_at
 * @property CarbonImmutable|null $updated_at
 * @property CarbonImmutable|null $deleted_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Campaign|null $campaign
 * @property-read Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read User|null $evaluator
 * @property-read float $weight
 * @property-read Objective|null $objective
 * @property-read Collection<int, UserPoints> $pointEntries
 * @property-read int|null $point_entries_count
 * @property-read UserPoints $points
 * @property-read mixed $trans
 * @property-read User|null $user
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective my(?\App\Models\Core\User $user = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective newQuery()
 * @method static Builder<static>|UserObjective onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereActive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereCompleted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereEvaluated()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereEvaluatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereEvaluatedBy($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereEvaluation($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereFailed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereNotEvaluated()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereObjectiveId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective wherePassed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereRealization($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereSelfEvaluatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereSelfEvaluation($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereSelfRealization($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereStatus($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereUserId($value)
 * @method static Builder<static>|UserObjective withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective withoutCache()
 * @method static Builder<static>|UserObjective withoutTrashed()
 * @mixin \Eloquent
 */
class UserObjective extends BaseModel implements AssignsPoints, HasDeadline
{
    use CanUserObjective;
    use Commentable;
    use HasUniqueUuid;

    protected $fillable = [
        'uuid',
        'user_id',
        'objective_id',
        'status',
        'evaluation',
        'realization',
        'evaluated_at',
        'evaluated_by',
        'self_realization',
        'self_evaluation',
        'self_evaluation_at',
    ];

    protected $defaults = [
        'status' => UserObjectiveStatus::UNSTARTED->value,
    ];

    protected $casts = [
        'evaluated_at' => 'datetime',
    ];

    public static function assign($user_id, $objective_id): bool
    {
        $output = false;
        $existing = self::where('user_id', $user_id)->where('objective_id', $objective_id)->exists();
        if (! $existing) {
            $instance = new self();
            $instance->user_id = $user_id;
            $instance->objective_id = $objective_id;
            if ($instance->save()) {
                $instance->refresh();
                $instance->setStatus()->updateQuietly();

                $output = true;
            }
        }

        return $output;
    }

    public static function unassign($user_id, $objective_id): bool
    {
        $output = false;
        $existing = self::where('user_id', $user_id)->where('objective_id', $objective_id)->first();
        if ($existing) {
            if ($existing->delete()) {
                $output = true;
            }
        }

        return $output;
    }

    public function getWeightAttribute(): float
    {
        return $this->objective->getAttribute('weight');
    }

    public function isOverdued(): bool
    {
        return $this->objective->isOverdued();
    }

    public function isAfterDeadline(): bool
    {
        return $this->objective->isAfterDeadline();
    }

    public function getStatusLabel(): string
    {
        return UserObjectiveStatus::labels()[$this->status] ?? '';
    }

    public function getStatusColor(): string
    {
        $output = match ($this->status) {
            UserObjectiveStatus::PASSED->value => 'passed',
            UserObjectiveStatus::FAILED->value => 'failed',
            UserObjectiveStatus::COMPLETED->value => 'completed',
            UserObjectiveStatus::INTERRUPTED->value => 'inactive',
            default => ''
        };
        if (empty($output) && $this->objective->isDeadlineUpcoming()) {
            $output = 'warning';
        }

        return $output;
    }

    public function setStatus(): self
    {
        $status = $this->status;
        $frozen = UserObjectiveStatus::frozen();

        $campaign = $this->objective->campaign ?? null;
        $userCampaign = null;
        if ($campaign) {
            $userCampaign = UserCampaign::where('user_id', $this->user_id)->where('campaign_id', $campaign->id)->first();
        }

        if ($userCampaign) {
            if (! $userCampaign->active) {
                $status = UserObjectiveStatus::INTERRUPTED->value;
            } else {
                $status = CampaignStage::mapObjectiveStatus($userCampaign->stage, $status);
            }
        }

        if (! in_array($status, $frozen)) {
            if ($this->isOverdued()) {
                $status = $this->autoEvaluate()->status;
            } else {
                if (! $userCampaign) {
                    $status = UserObjectiveStatus::PROGRESS->value;
                }
            }
        }

        $this->status = $status ?? UserObjectiveStatus::UNSTARTED->value;

        return $this;
    }

    public function objective(): BelongsTo
    {
        return $this->belongsTo(Objective::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluated_by')->withTrashed();
    }

    public function points(): ?MorphOne
    {
        return $this->morphOne(UserPoints::class, 'subject')->withDefault([
            'user_id' => $this->user_id,
        ])->whereUserId($this->user_id);
    }

    public function pointEntries(): MorphMany
    {
        return $this->morphMany(UserPoints::class, 'subject');
    }

    public function calculatePoints(): float
    {
        $points = 0;

        $award = $this->objective->award ?? 0;
        if ($award > 0) {
            $points = round($award * ($this->evaluation / 100), 2);
        }

        return $points;
    }

    public function campaign(): HasOneThrough
    {
        return $this->hasOneThrough(Campaign::class, Objective::class, 'campaign_id', 'id', 'id', 'campaign_id');
    }

    public function user_campaign(): ?UserCampaign
    {
        if ($this->campaign?->relationLoaded('user_campaigns')) {
            return $this->campaign->user_campaigns->firstWhere('user_id', $this->user_id);
        }

        if ($this->campaign) {
            return $this->campaign->user_campaigns()->where('user_id', $this->user_id)->first();
        }

        return null;
    }

    public function isPassed(): bool
    {
        return UserObjectiveStatus::PASSED->value === $this->status;
    }

    public function isFailed(): bool
    {
        return UserObjectiveStatus::FAILED->value === $this->status;
    }

    public function isCompleted(): bool
    {
        return in_array($this->status, [UserObjectiveStatus::COMPLETED->value, UserObjectiveStatus::PASSED->value, UserObjectiveStatus::FAILED->value], true);
    }

    public function isEvaluated(): bool
    {
        return in_array($this->status, UserObjectiveStatus::evaluated()) || $this->evaluated_at !== null;
    }

    public function isSelfEvaluated(): bool
    {
        return $this->self_evaluated_at !== null;
    }

    public function scopeWhereActive(Builder $query): void
    {
        $query->whereNotIn('user_objectives.status', UserObjectiveStatus::frozen());
    }

    public function scopeWhereNotEvaluated(Builder $query): void
    {
        $query->whereNotIn('user_objectives.status', UserObjectiveStatus::evaluated());
    }

    public function scopeWhereEvaluated(Builder $query): void
    {
        $query->whereIn('user_objectives.status', UserObjectiveStatus::evaluated());
    }

    public function scopeWhereCompleted(Builder $query): void
    {
        $query->where('user_objectives.status', UserObjectiveStatus::COMPLETED->value);
    }

    public function scopeWherePassed(Builder $query): void
    {
        $query->where('user_objectives.status', UserObjectiveStatus::PASSED->value);
    }

    public function scopeWhereFailed(Builder $query): void
    {
        $query->where('user_objectives.status', UserObjectiveStatus::FAILED->value);
    }

    public function scopeMy(Builder $query, ?User $user = null): void
    {
        if (! $user) {
            $user = Auth::user();
        }
        $query->where('user_objectives.user_id', $user->id);
    }

    public function setCompleted(): self
    {
        $this->status = UserObjectiveStatus::COMPLETED->value;

        return $this;
    }

    public function autoEvaluate(): self
    {
        if ($this->isOverdued()) {
            $this->status = UserObjectiveStatus::COMPLETED->value;
            $autofail = settings('mbo.objectives_autofail', true);
            if ($autofail) {
                if ((! $this->evaluation || $this->evaluation < 100)) {
                    $this->setFailed(true);
                } else {
                    $this->setPassed(true);
                }
            }
        }

        return $this;
    }

    public function setFailed(bool $auto = false): self
    {
        $this->status = UserObjectiveStatus::FAILED->value;

        if ($this->evaluation >= 100) {
            $this->evaluation = null;
        }
        $this->evaluated_at = now();
        if (! $auto) {
            $this->evaluated_by = Auth::user()->id;
        }
        $this->points()->delete();

        return $this;
    }

    public function setPassed(bool $auto = false): self
    {
        $this->status = UserObjectiveStatus::PASSED->value;
        if (! $this->evaluation) {
            $this->evaluation = 100;
        }
        $this->evaluated_at = now();
        if (! $auto) {
            $this->evaluated_by = Auth::user()->id;
        }

        $this->points()->updateOrCreate([
            'user_id' => $this->user_id,
            'points' => $this->calculatePoints(),
            'assigned_by' => $this->evaluated_by,
        ]);

        return $this;
    }

    protected static function booted(): void
    {
        static::addGlobalScope('required_relations', function (Builder $builder): void {
            $builder->with(['user', 'objective']);
        });
    }

    protected static function boot(): void
    {
        parent::boot();
        static::updating(function (self $model): self {
            if ($model->isDirty('status')) {
                if ($model->isPassed()) {
                    UserObjectivePassed::dispatch($model);
                } elseif ($model->isFailed()) {
                    UserObjectiveFailed::dispatch($model);
                }
            } else {
                $model->setStatus();
            }

            return $model;
        });

        static::creating(function (self $model): self {
            $model->setStatus();

            return $model;
        });

        static::created(function (self $model): void {
            $campaign = $model->objective->campaign ?? null;
            if ($campaign) {
                CampaignUserObjectiveAssigned::dispatch($model->user, $model->objective, $campaign);
            } else {
                UserObjectiveAssigned::dispatch($model);
            }
        });

        static::deleted(function (self $model): void {
            $campaign = $model->objective->campaign ?? null;
            if ($campaign) {
                CampaignUserObjectiveUnassigned::dispatch($model->user, $model->objective, $campaign);
            } else {
                UserObjectiveUnassigned::dispatch($model);
            }
        });
    }
}
