<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
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
 * @property Collection<array-key, mixed>|null $properties
 * @property string|null $batch_uuid
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|null $causer
 * @property-read Collection $changes
 * @property-read Model|null $subject
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel causedBy(\Illuminate\Database\Eloquent\Model $causer)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel forBatch(string $batchUuid)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel forEvent(string $event)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel forSubject(\Illuminate\Database\Eloquent\Model $subject)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel hasBatch()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel inLog(...$logNames)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel logger()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel mine()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereBatchUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereCauserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereCauserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereLogName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Vendor\ActivityModel whereUpdatedAt($value)
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
