<?php

namespace App\Traits;

use App\Models\Core\User;
use App\Models\Mbo\Campaign;
use App\Models\Mbo\Objective;
use App\Models\Mbo\UserCampaign;
use App\Models\Mbo\UserObjective;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait IsTranslated
{
    public function trans(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name,
        );
    }

    protected static function matchModelTranslation(): ?string
    {
        return match (static::class) {
            User::class => 'Użytkownik',
            Campaign::class => 'Kampania',
            UserCampaign::class => 'Przypisanie do kampanii',
            Objective::class => 'Cel',
            UserObjective::class => 'Przypisanie do celu',

            default => null,
        };
    }
}
