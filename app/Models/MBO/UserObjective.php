<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\MBO\Objective;
use App\Enums\MBO\UserObjectiveStatus;

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

    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
