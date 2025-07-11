<?php

namespace App\Listeners\Activity;

use App\Models\Core\User;
use Illuminate\Auth\Events\Failed as AuthFailed;

class LogAuthFailed
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AuthFailed $event): void
    {
        if ($event->user) {
            $user = User::find($event->user->id);
            if ($user) {
                activity('auth')
                    ->causedBy($user)
                    ->withProperties(['authenticated' => false])
                    ->event('auth_attempt_fail')
                    ->log(__('logging.description.auth_attempt_fail'));
            }
        }
    }
}
