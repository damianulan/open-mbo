<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\MBO\Objective;

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
