<?php

namespace App\Models\MBO;

use App\Commentable\Support\Commentable;
use App\Contracts\MBO\AssignsPoints;
use App\Enums\MBO\CampaignStage;
use App\Enums\MBO\UserObjectiveStatus;
use App\Events\MBO\Campaigns\CampaignUserObjectiveAssigned;
use App\Events\MBO\Campaigns\CampaignUserObjectiveUnassigned;
use App\Events\MBO\Objectives\UserObjectiveAssigned;
use App\Events\MBO\Objectives\UserObjectiveEvaluated;
use App\Events\MBO\Objectives\UserObjectiveUnassigned;
use App\Models\BaseModel;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;
use Lucent\Support\Traits\Dispatcher;

/**
 * @property string $id
 * @property string $user_id
 * @property string $objective_id
 * @property string $status objective status
 * @property string|null $realization Numerical value of the realization of the objective - in relation to the expected value in objective
 * @property string|null $evaluation Percentage evaluation of the objective - if realization is set, evaluation is calculated automatically
 * @property \Illuminate\Support\Carbon|null $evaluated_at Time when most recent evaluation was made
 * @property string|null $evaluated_by Time when most recent evaluator has made any changes
 * @property string|null $self_realization Numerical value of the realization of the objective - in relation to the expected value in objective
 * @property string|null $self_evaluation Percentage evaluation of the objective - if realization is set, evaluation is calculated automatically
 * @property string|null $self_evaluated_at Time when most recent self evaluation was made
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\MBO\Campaign|null $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Commentable\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read User|null $evaluator
 * @property-read \App\Models\MBO\Objective $objective
 * @property-read \App\Models\MBO\UserPoints $points
 * @property-read User $user
 *
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
 *
 * @mixin \Eloquent
 */
class UserObjective extends BaseModel implements AssignsPoints
{
    use Commentable, Dispatcher;

    protected $fillable = [
        'user_id',
        'objective_id',
        'status',
        'evaluation', // percentage evaluation
        'realization', // actual realization value - can remain null
        'evaluated_at',
        'evaluated_by',
        'self_realization',
        'self_evaluation',
        'self_evaluation_at',
    ];

    protected $defaults = [
        'status' => UserObjectiveStatus::UNSTARTED,
    ];

    protected $casts = [
        'evaluated_at' => 'datetime',
    ];

    public static function assign($user_id, $objective_id): bool
    {
        $output = false;
        $existing = self::where('user_id', $user_id)->where('objective_id', $objective_id)->exists();
        if (! $existing) {
            $instance = new self;
            $instance->user_id = $user_id;
            $instance->objective_id = $objective_id;
            if ($instance->save()) {
                $instance->refresh();
                $instance->setStatus()->updateQuietly();

                return true;
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

    public function isAfterDeadline(): bool
    {
        return $this->objective->isOverdued();
    }

    public function getStatusLabel(): string
    {
        return UserObjectiveStatus::labels()[$this->status] ?? '';
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
                $status = UserObjectiveStatus::INTERRUPTED;
            } else {
                $status = CampaignStage::mapObjectiveStatus($userCampaign->stage, $status);
            }
        }

        if (! in_array($status, $frozen)) {
            if ($this->isAfterDeadline()) {
                $this->autoEvaluate();
            } else {
                if (! $userCampaign) {
                    $status = UserObjectiveStatus::PROGRESS;
                }
            }
        }

        $this->status = $status ?? UserObjectiveStatus::UNSTARTED;

        return $this;
    }

    public function objective(): BelongsTo
    {
        return $this->belongsTo(Objective::class)->withTrashed();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluated_by')->withTrashed();
    }

    public function points(): MorphOne
    {
        return $this->morphOne(UserPoints::class, 'subject')->withDefault([
            'user_id' => $this->user_id,
        ])->whereUserId($this->user_id);
    }

    public function campaign(): Attribute
    {
        return Attribute::make(
            get: function (): ?Campaign {
                return Campaign::whereHas('objectives', function (Builder $query) {
                    $query->where('id', $this->objective_id);
                })->whereHas('user_campaigns', function (Builder $query) {
                    $query->where('user_id', $this->user_id);
                })->first();
            }
        );
    }

    public function canBeEvaluated(): bool
    {
        return in_array($this->status, UserObjectiveStatus::finished());
    }

    public function canBeFailed(): bool
    {
        return $this->canBeEvaluated() && $this->status !== UserObjectiveStatus::FAILED;
    }

    public function canBePassed(): bool
    {
        return $this->canBeEvaluated() && $this->status !== UserObjectiveStatus::PASSED;
    }

    public function isPassed(): bool
    {
        return $this->status === UserObjectiveStatus::PASSED;
    }

    public function isFailed(): bool
    {
        return $this->status === UserObjectiveStatus::FAILED;
    }

    public function isCompleted(): bool
    {
        return in_array($this->status, [UserObjectiveStatus::COMPLETED, UserObjectiveStatus::PASSED, UserObjectiveStatus::FAILED]);
    }

    public function isEvaluated(): bool
    {
        return in_array($this->status, UserObjectiveStatus::evaluated());
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
        $query->where('user_objectives.status', UserObjectiveStatus::COMPLETED);
    }

    public function scopeWherePassed(Builder $query): void
    {
        $query->where('user_objectives.status', UserObjectiveStatus::PASSED);
    }

    public function scopeWhereFailed(Builder $query): void
    {
        $query->where('user_objectives.status', UserObjectiveStatus::FAILED);
    }

    public function scopeMy(Builder $query, ?User $user = null): void
    {
        if (! $user) {
            $user = Auth::user();
        }
        $query->where('user_objectives.user_id', $user->id);
    }

    public static function creatingUserObjective(UserObjective $model): UserObjective
    {
        $model->setStatus();

        return $model;
    }

    public static function createdUserObjective(UserObjective $model): void
    {
        $campaign = $model->objective->campaign ?? null;
        if ($campaign) {
            CampaignUserObjectiveAssigned::dispatch($model->user, $model->objective, $campaign);
        } else {
            UserObjectiveAssigned::dispatch($model->user, $model->objective);
        }
    }

    public static function updatedUserObjective(UserObjective $model): void
    {
        if ($model->isDirty('status') && ! in_array($model->getOriginal('status'), UserObjectiveStatus::evaluated())) {
            if ($model->isEvaluated()) {
                UserObjectiveEvaluated::dispatch($model, Auth::user() ?? null);
            }
        } else {
            $model->setStatus()->updateQuietly();
        }
    }

    public static function deletedUserObjective(UserObjective $model): void
    {
        $campaign = $model->objective->campaign ?? null;
        if ($campaign) {
            CampaignUserObjectiveUnAssigned::dispatch($model->user, $model->objective, $campaign);
        } else {
            UserObjectiveUnassigned::dispatch($model->user, $model->campaign);
        }
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

    public function setCompleted(): self
    {
        $this->status = UserObjectiveStatus::COMPLETED;

        return $this;
    }

    public function autoEvaluate(): self
    {
        if ($this->isAfterDeadline()) {
            $this->status = UserObjectiveStatus::COMPLETED;
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
        $this->status = UserObjectiveStatus::FAILED;

        if ($this->evaluation >= 100) {
            $this->evaluation = null;
        }
        $this->evaluated_at = now();
        if (! $auto) {
            $this->evaluated_by = Auth::user()->id;
        }
        $this->points()->delete();

        // based on settings - award event if failed
        // $this->points()->updateOrCreate([
        //     'user_id' => $this->user_id,
        //     'points' => $this->calculatePoints(),
        //     'assigned_by' => $this->evaluated_by,
        // ]);

        return $this;
    }

    public function setPassed(bool $auto = false): self
    {
        $this->status = UserObjectiveStatus::PASSED;
        if (! $this->evaluation) {
            $this->evaluation = 100;
        }
        $this->evaluated_at = now();
        if (! $auto) {
            $this->evaluated_by = Auth::user()->id;
        }

        // TODO do not commit
        $this->points()->updateOrCreate([
            'user_id' => $this->user_id,
            'points' => $this->calculatePoints(),
            'assigned_by' => $this->evaluated_by,
        ]);

        return $this;
    }
}
