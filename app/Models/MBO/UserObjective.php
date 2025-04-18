<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\MBO\Objective;
use App\Enums\MBO\UserObjectiveStatus;

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
    protected $fillable = [
        'user_id',
        'objective_id',
        'status',
        'evaluation',
    ];

    protected $casts = [
        'status' => UserObjectiveStatus::class,
        'evaluation' => 'decimal:8,2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if(!$model->status){
                $model->status = UserObjectiveStatus::UNSTARTED->value;
            }

            return $model;
        });
    }

    public static function assign($user_id, $objective_id): bool
    {
        $output = false;
        $existing = self::where('user_id', $user_id)->where('objective_id', $objective_id)->exists();
        if(!$existing){
            $instance = new self();
            $instance->user_id = $user_id;
            $instance->objective_id = $objective_id;
            if($instance->save()){
                return true;
            }
        }
        return $output;
    }

    public static function unassign($user_id, $objective_id): bool
    {
        $output = false;
        $existing = self::where('user_id', $user_id)->where('objective_id', $objective_id)->first();
        if($existing){
            if($existing->delete()){
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


}
