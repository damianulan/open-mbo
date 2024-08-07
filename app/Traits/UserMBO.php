<?php

namespace App\Traits;

use App\Models\MBO\UserObjective;
use App\Models\MBO\BonusScheme;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\ObjectiveEvaluation;
use App\Models\MBO\UserBonusAssignment;

trait UserMBO
{

    public function objective_assignments()
    {
        return $this->hasMany(UserObjective::class);
    }

    public function campaigns()
    {
        return $this->hasMany(UserCampaign::class);
    }

    public function coordinator_campaigns()
    {
        return $this->belongsToMany(static::class, 'campaigns_coordinators', 'coordinator_id', 'campaign_id')->where('active', 1);
    }

}
