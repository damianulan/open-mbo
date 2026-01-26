<?php

namespace App\Traits;

use App\Models\Core\UserPreference;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserHasPreferences
{
    public function preferences(): HasOne
    {
        return $this->hasOne(UserPreference::class)->withTrashed();
    }

    protected static function bootUserHasPreferences(): void
    {

        static::created(function ($user): void {
            if (empty($user->preferences)) {
                $user->preferences()->create();
            }
        });

        static::deleting(function ($user): void {
            $user->preferences->delete();
        });
    }
}
