<?php

namespace App\Observers;

use App\Factories\Users\UserStatusFactory;
use App\Models\Core\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user): User
    {
        if (! isset($user->password) || empty($user->password)) {
            $user->generatePassword();
        }
        if (! $user->username) {
            $user->username = Str::ascii(Str::lower($user->firstname . '.' . $user->lastname));
        }

        return $user;
    }

    public function created(User $user): void
    {
        if ($user->password) {
            $user->passwordHistory()->create([
                'password' => $user->password,
            ]);
        }
        $this->setStatusAuto($user);
    }

    public function updating(User $user): User
    {
        return $user;
    }

    public function updated(User $user): void
    {
        if ($user->isDirty('password')) {
            $user->passwordHistory()->create([
                'password' => $user->password,
            ]);
        }
        $this->setStatusAuto($user);
    }

    public function deleted(User $user): void
    {
        $this->setStatusAuto($user);
    }

    public function restored(User $user): void
    {
        $this->setStatusAuto($user);
    }

    public function forceDeleted(User $user): void
    {
    }

    private function setStatusAuto(User $user): void
    {
        $user->setStatus(UserStatusFactory::make($user), 'auto');
    }
}
