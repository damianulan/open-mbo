<?php

namespace App\Traits;

use App\Models\MBO\Campaign;
use App\Models\MBO\UserBonusScheme;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\UserObjective;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserMBO
{
    public function objective_assignments(): HasMany
    {
        return $this->hasMany(UserObjective::class);
    }

    public function objectives(): HasMany
    {
        return $this->objective_assignments()->whereHas('objective', function (Builder $query) {
            $query->where('draft', 0);
        });
    }

    public function user_bonus_scheme(): BelongsTo
    {
        return $this->belongsTo(UserBonusScheme::class);
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(UserCampaign::class);
    }

    public function coordinator_campaigns(): BelongsToMany
    {
        return $this->belongsToMany(static::class, 'campaigns_coordinators', 'coordinator_id', 'campaign_id')->where('active', 1);
    }

    public function isCampaignCoordinator(Campaign $campaign): bool
    {
        return $campaign->coordinators()->contains('coordinator_id', $this->id);
    }

    public function isMBOAdmin(): bool
    {
        return $this->hasAnyRoles(['root', 'support', 'admin', 'admin_mbo']);
    }
}
