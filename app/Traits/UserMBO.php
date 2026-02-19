<?php

namespace App\Traits;

use App\Models\MBO\BonusScheme;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Models\MBO\UserBonusScheme;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\UserObjective;
use App\Models\MBO\UserPoints;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        $this->user_bonus_scheme()->create([
            'user_id' => $this->id,
            'bonus_scheme_id' => $scheme->id,
        ]);
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

    public function awards(): HasMany
    {
        return $this->hasMany(UserPoints::class, 'user_id');
    }

    public function points(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->awards->sum('points'),
        );
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(UserCampaign::class);
    }

    public function campaigns_ongoing(): HasMany
    {
        return $this->hasMany(UserCampaign::class)->ongoing()->orderForUser();
    }

    public function isCampaignCoordinator(Campaign $campaign): bool
    {
        return $campaign->coordinators()->contains('coordinator_id', $this->id);
    }

    public function isMBOAdmin(): bool
    {
        return $this->hasAnyRoles(['root', 'support', 'admin', 'admin_mbo']);
    }

    public function isEnrolledInCampaign(Campaign $campaign): bool
    {
        return $this->user_campaigns()->where('campaign_id', $campaign->id)->exists();
    }
}
