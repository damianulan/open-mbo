<?php

namespace App\Observers;

use App\Models\Core\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user): User
    {
        if ( ! isset($user->password) || empty($user->password)) {
            $user->generatePassword();
        }
        if(!$user->username){
            $user->username = Str::ascii(Str::lower($user->firstname . '.' . $user->lastname));
        }

        return $user;
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ($user->password) {
            $user->password_history()->create([
                'password' => $user->password,
            ]);
        }
    }

    public function updating(User $user): User
    {
        return $user;
    }


    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if($user->isDirty('password')){
            $user->password_history()->create([
                'password' => $user->password,
            ]);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
