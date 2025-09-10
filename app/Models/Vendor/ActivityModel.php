<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

/**
 * @property int $id
 * @property string|null $log_name
 * @property string $description
 * @property string|null $subject_type
 * @property string|null $event
 * @property string|null $subject_id
 * @property string|null $causer_type
 * @property string|null $causer_id
 * @property \Illuminate\Support\Collection<array-key, mixed>|null $properties
 * @property string|null $batch_uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|null $causer
 * @property-read \Illuminate\Support\Collection $changes
 * @property-read \Illuminate\Database\Eloquent\Model|null $subject
 *
 * @method static Builder<static>|ActivityModel causedBy(\Illuminate\Database\Eloquent\Model $causer)
 * @method static Builder<static>|ActivityModel forBatch(string $batchUuid)
 * @method static Builder<static>|ActivityModel forEvent(string $event)
 * @method static Builder<static>|ActivityModel forSubject(\Illuminate\Database\Eloquent\Model $subject)
 * @method static Builder<static>|ActivityModel hasBatch()
 * @method static Builder<static>|ActivityModel inLog(...$logNames)
 * @method static Builder<static>|ActivityModel logger()
 * @method static Builder<static>|ActivityModel mine()
 * @method static Builder<static>|ActivityModel newModelQuery()
 * @method static Builder<static>|ActivityModel newQuery()
 * @method static Builder<static>|ActivityModel query()
 * @method static Builder<static>|ActivityModel whereBatchUuid($value)
 * @method static Builder<static>|ActivityModel whereCauserId($value)
 * @method static Builder<static>|ActivityModel whereCauserType($value)
 * @method static Builder<static>|ActivityModel whereCreatedAt($value)
 * @method static Builder<static>|ActivityModel whereDescription($value)
 * @method static Builder<static>|ActivityModel whereEvent($value)
 * @method static Builder<static>|ActivityModel whereId($value)
 * @method static Builder<static>|ActivityModel whereLogName($value)
 * @method static Builder<static>|ActivityModel whereProperties($value)
 * @method static Builder<static>|ActivityModel whereSubjectId($value)
 * @method static Builder<static>|ActivityModel whereSubjectType($value)
 * @method static Builder<static>|ActivityModel whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ActivityModel extends Activity
{
    public function scopeLogger(Builder $query): void
    {
        $query->whereIn('activity_log.event', ['viewed', 'created', 'updated', 'deleted', 'impersonated', 'auth_attempt_success', 'auth_attempt_fail']);
    }

    public function scopeMine(Builder $query): void
    {
        $query->where('activity_log.causer_id', Auth::user()->id)->where('activity_log.causer_type', Auth::user()->getMorphClass());
    }
}
