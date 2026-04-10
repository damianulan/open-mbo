<?php

namespace App\Factories\Users;

use App\Enums\Users\UserStatus;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Builder;

class UserStatusFactory
{
    public static function withEmploymentExists(Builder $query): Builder
    {
        return $query->withExists('employment as employment_exists');
    }

    public static function make(User $user): UserStatus
    {
        return match (true) {
            $user->deleted_at !== null => UserStatus::DELETED,
            $user->suspended_at !== null => UserStatus::SUSPENDED,
            $user->email_verified_at === null => UserStatus::UNVERIFIED,
            ! self::hasEmployment($user) => UserStatus::UNEMPLOYED,
            default => UserStatus::ACTIVE,
        };
    }

    private static function hasEmployment(User $user): bool
    {
        if (array_key_exists('employment_exists', $user->getAttributes())) {
            return (bool) $user->getAttribute('employment_exists');
        }

        $user->load('employment');

        return $user->getRelation('employment') !== null;
    }
}
