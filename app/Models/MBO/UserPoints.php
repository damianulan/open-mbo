<?php

namespace App\Models\MBO;

use App\Models\BaseModel;

/**
 * @property int $id
 * @property string $user_id
 * @property string $subject_type
 * @property string $subject_id
 * @property string|null $points
 * @property string $assigned_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereAssignedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints withoutTrashed()
 *
 * @mixin \Eloquent
 */
class UserPoints extends BaseModel
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'subject_type',
        'points',
        'assigned_by',
    ];
}
