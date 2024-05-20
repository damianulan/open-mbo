<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\MBO\Objective;

class ObjectiveGoal extends BaseModel
{
    protected $fillable = [
        'objective_type',
        'objective_id',
        'text',
    ];

}
