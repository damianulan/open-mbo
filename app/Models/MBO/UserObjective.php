<?php

namespace App\Models\MBO;

use App\Commentable\Support\Commentable;
use App\Enums\MBO\CampaignStage;
use App\Enums\MBO\UserObjectiveStatus;
use App\Events\MBO\Campaigns\CampaignUserObjectiveAssigned;
use App\Events\MBO\Campaigns\CampaignUserObjectiveUnassigned;
use App\Events\MBO\Objectives\UserObjectiveAssigned;
use App\Events\MBO\Objectives\UserObjectiveUnassigned;
use App\Models\BaseModel;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Lucent\Support\Traits\Dispatcher;

/**
 * @property string $id
 * @property string $user_id
 * @property string $objective_id
 * @property string $status objective status
 * @property string|null $realization Numerical value of the realization of the objective - in relation to the expected value in objective
 * @property string|null $evaluation Percentage evaluation of the objective - if realization is set, evaluation is calculated automatically
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\MBO\Campaign|null $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Commentable\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Commentable\Models\Comment> $comments_direct
 * @property-read int|null $comments_direct_count
 * @property-read \App\Models\MBO\Objective $objective
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
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereEvaluation($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereFailed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereNotEvaluated()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereObjectiveId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective wherePassed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereRealization($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereStatus($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective whereUserId($value)
 * @method static Builder<static>|UserObjective withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserObjective withoutCache()
 * @method static Builder<static>|UserObjective withoutTrashed()
 *
 * @mixin \Eloquent
 */
class UserObjective extends BaseModel
{
    use Commentable, Dispatcher;

    protected $fillable = [
        'user_id',
        'objective_id',
        'status',
        'evaluation', // percentage evaluation
        'realization', // actual realization value - can remain null
    ];

    protected $defaults = [
        'status' => UserObjectiveStatus::UNSTARTED,
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
        if ($this->objective?->deadline) {
            return $this->objective?->deadline->isPast();
        }

        return false;
    }

    public function getStatusLabel(): string
    {
        return UserObjectiveStatus::labels()[$this->status] ?? '';
    }

    public function setStatus(): self
    {
        $status = $this->status;
        $frozen = UserObjectiveStatus::frozen();
        $autofail = settings('mbo.objectives_autofail');

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
                if ($autofail) {
                    // TODO fail when expected value is filled and not met
                } else {
                }
                $status = UserObjectiveStatus::COMPLETED;
            } else {
                if (! $userCampaign) {
                    $status = UserObjectiveStatus::PROGRESS;
                }
            }
        }

        $this->status = $status;

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

    public function scopeWhereActive(Builder $query): void
    {
        $query->whereNotIn('status', UserObjectiveStatus::frozen());
    }

    public function scopeWhereNotEvaluated(Builder $query): void
    {
        $query->whereNotIn('status', UserObjectiveStatus::evaluated());
    }

    public function scopeWhereEvaluated(Builder $query): void
    {
        $query->whereIn('status', UserObjectiveStatus::evaluated());
    }

    public function scopeWhereCompleted(Builder $query): void
    {
        $query->where('status', UserObjectiveStatus::COMPLETED);
    }

    public function scopeWherePassed(Builder $query): void
    {
        $query->where('status', UserObjectiveStatus::PASSED);
    }

    public function scopeWhereFailed(Builder $query): void
    {
        $query->where('status', UserObjectiveStatus::FAILED);
    }

    public function scopeMy(Builder $query, ?User $user = null): void
    {
        if (! $user) {
            $user = Auth::user();
        }
        $query->where('user_id', $user->id);
    }

    public static function retrievedUserObjective(UserObjective $model): void
    {
        $model->setStatus()->update();
    }

    public static function creatingUserObjective(UserObjective $model): UserObjective
    {
        $model->setStatus();

        return $model;
    }

    /**
     * Handle the UserObjective "created" event.
     */
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
        if (! in_array('status', $model->getDirty())) {
            $model->setStatus()->updateQuietly();
        }
    }

    /**
     * Handle the UserObjective "deleted" event.
     */
    public static function deletedUserObjective(UserObjective $model): void
    {
        $campaign = $model->objective->campaign ?? null;
        if ($campaign) {
            CampaignUserObjectiveUnAssigned::dispatch($model->user, $model->objective, $campaign);
        } else {
            UserObjectiveUnassigned::dispatch($model->user, $model->campaign);
        }
    }
}
