<?php

namespace App\Factories\Users;

use App\Enums\Users\UserStatus;
use App\Models\Core\User;

class UserStatusFactory
{
    public static function make(User $user): UserStatus
    {
        $status = UserStatus::ACTIVE;

        if(!$user->employment) {
            $status = UserStatus::UNEMPLOYED;
        }
        if(!$user->email_verified_at){
            $status = UserStatus::UNVERIFIED;
        }
        if($user->suspended_at){
            $status = UserStatus::SUSPENDED;
        }
        if($user->deleted_at){
            $status = UserStatus::DELETED;
        }
        return UserStatus::tryFrom($status);
    }
}

