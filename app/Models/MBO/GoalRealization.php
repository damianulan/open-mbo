<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\MBO\Objective;

/**
 * 
 *
 * @property string $id
 * @property string $user_objective_id
 * @property string $objective_goal_id
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization whereObjectiveGoalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization whereUserObjectiveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GoalRealization withoutTrashed()
 * @mixin \Eloquent
 */
class GoalRealization extends BaseModel
{
    protected $fillable = [
        'user_objective_id',
        'objective_goal_id',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

}
