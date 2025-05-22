<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\MBO\Objective;
use App\Enums\MBO\UserObjectiveStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\MBO\Objectives\UserObjectiveObserver;
use App\Traits\Dispatcher;

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

    public function scopeMy(Builder $query, ?User $user = null): void
    {
        if (!$user) {
            $user = Auth::user();
        }
        $query->where('user_id', $user->id);
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
