<?php

namespace App\Traits;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait IsTranslated
{
    public function trans(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->name,
        );
    }

    protected static function matchModelTranslation(): ?string
    {
        return match (static::class) {
            \App\Models\Core\User::class => 'Użytkownik',
            \App\Models\MBO\Campaign::class => 'Kampania',
            \App\Models\MBO\UserCampaign::class => 'Przypisanie do kampanii',
            \App\Models\MBO\Objective::class => 'Cel',
            \App\Models\MBO\UserObjective::class => 'Przypisanie do celu',


            default => null,
        };
    }

}
