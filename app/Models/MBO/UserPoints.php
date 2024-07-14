<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\MBO\Objective;

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
