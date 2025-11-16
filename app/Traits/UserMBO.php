<?php

namespace App\Traits;

use App\Models\MBO\BonusScheme;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Models\MBO\UserBonusScheme;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\UserObjective;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

trait UserMBO
{
    public function user_objectives(): HasMany
    {
        return $this->hasMany(UserObjective::class);
    }

    public function user_objectives_active(): HasMany
    {
        return $this->user_objectives()->whereHas('objective', function (Builder $query): void {
            $query->where('draft', 0);
        });
    }

    public function assignBonusScheme(BonusScheme $scheme): void
    {
        $this->user_bonus_scheme()->delete();
        $this->user_bonus_scheme()->create(array(
            'user_id' => $this->id,
            'bonus_scheme_id' => $scheme->id,
        ));
    }

    public function objectives(): HasManyThrough
    {
        return $this->hasManyThrough(Objective::class, UserObjective::class, 'user_id', 'id', 'id', 'objective_id');
    }

    public function user_bonus_scheme(): BelongsTo
    {
        return $this->belongsTo(UserBonusScheme::class);
    }

    public function bonus_scheme(): HasOneThrough
    {
        return $this->hasOneThrough(BonusScheme::class, UserBonusScheme::class, 'user_id', 'id', 'id', 'bonus_scheme_id');
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
        return $this->hasAnyRoles(array('root', 'support', 'admin', 'admin_mbo'));
    }
}
