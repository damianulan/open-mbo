<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\MBO\Objective;
use App\Enums\MBO\UserObjectiveStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Traits\Dispatcher;
use Carbon\Carbon;
use App\Models\MBO\UserCampaign;
use App\Enums\MBO\CampaignStage;
use App\Events\MBO\Campaigns\CampaignUserObjectiveAssigned;
use App\Events\MBO\Campaigns\CampaignUserObjectiveUnassigned;
use App\Events\MBO\Objectives\UserObjectiveAssigned;
use App\Events\MBO\Objectives\UserObjectiveUnassigned;

/**
 *
 *
 * @property string $id
 * @property string $user_id
 * @property string $objective_id
 * @property UserObjectiveStatus $status
 * @property numeric|null $evaluation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Objective $objective
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereEvaluation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereObjectiveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective withoutTrashed()
 * @mixin \Eloquent
 */
class UserObjective extends BaseModel
{
    use Dispatcher;

    protected $fillable = [
        'user_id',
        'objective_id',
        'status',
        'evaluation',
    ];

    protected $casts = [
        'evaluation' => 'decimal:8,2',
    ];

    protected $defaults = [
        'status' => UserObjectiveStatus::UNSTARTED,
    ];

    public static function assign($user_id, $objective_id): bool
    {
        $output = false;
        $existing = self::where('user_id', $user_id)->where('objective_id', $objective_id)->exists();
        if (!$existing) {
            $instance = new self();
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
        $deadline = Carbon::parse($this->objective->deadline);
        if ($deadline) {
            return $deadline->isPast();
        }

        return false;
    }

    public function setStatus(): self
    {
        $status = $this->status;
        $frozen = UserObjectiveStatus::frozen();
        $autofail = setting('mbo.objectives_autofail');

        $campaign = $this->objective->campaign ?? null;
        $userCampaign = null;
        if ($campaign) {
            $userCampaign = UserCampaign::where('user_id', $this->user_id)->where('campaign_id', $campaign->id)->first();
        }

        if ($userCampaign) {
            if (!$userCampaign->active) {
                $status = UserObjectiveStatus::INTERRUPTED;
            } else {
                $status = CampaignStage::mapObjectiveStatus($userCampaign->stage, $status);
            }
        }

        if (!in_array($status, $frozen)) {
            if ($this->isAfterDeadline()) {
                if ($autofail) {
                    // TODO fail when expected value is filled and not met
                } else {
                }
                $status = UserObjectiveStatus::COMPLETED;
            } else {
                if (!$userCampaign) {
                    $status = UserObjectiveStatus::PROGRESS;
                }
            }
        }

        $this->status = $status;

        return $this;
    }

    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function scopeMy(Builder $query, ?User $user = null): void
    {
        if (!$user) {
            $user = Auth::user();
        }
        $query->where('user_id', $user->id);
    }

    public static function retrievedUserObjective(UserObjective $model): void
    {
        $model->setStatus()->update();
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

    public static function updatingUserObjective(UserObjective $model): UserObjective
    {

        return $model;
    }

    public static function updatedUserObjective(UserObjective $model): void
    {
        if (in_array('status', $model->getDirty())) {
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
