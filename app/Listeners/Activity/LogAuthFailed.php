<?php

namespace App\Listeners\Activity;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Failed;
use App\Models\Core\User;

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
    public function handle(Failed $event): void
    {
        if($event->user){
            $user = User::find($event->user->id);
            if($user){
                activity('auth')
                ->causedBy($user)
                ->withProperties(['authenticated' => false])
                ->event('auth_attempt_fail')
                ->log('auth_attempt');
            }
        }
    }
}
