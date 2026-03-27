<?php

namespace App\Factories\Users;

use App\Enums\Users\UserStatus;
use App\Models\Core\User;

class UserStatusFactory
{
    public static function make(User $user): UserStatus
    {
        return match (true) {
            null !== $user->deleted_at => UserStatus::DELETED,
            null !== $user->suspended_at => UserStatus::SUSPENDED,
            null === $user->email_verified_at => UserStatus::UNVERIFIED,
            ! self::hasEmployment($user) => UserStatus::UNEMPLOYED,
            default => UserStatus::ACTIVE,
        };
    }

    private static function hasEmployment(User $user): bool
    {
        $user->load('employment');

        return null !== $user->getRelation('employment');
    }
}
