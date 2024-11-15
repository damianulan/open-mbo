<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\MBO\Objective;

/**
 * 
 *
 * @property string $id
 * @property string $objective_type
 * @property string $objective_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal whereObjectiveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal whereObjectiveType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveGoal withoutTrashed()
 * @mixin \Eloquent
 */
class ObjectiveGoal extends BaseModel
{
    protected $fillable = [
        'objective_type',
        'objective_id',
        'text',
    ];

}
