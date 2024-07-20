<?php

namespace App\Listeners\Activity;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Logout;
use App\Models\Core\User;

class LogSuccessfulLogout
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
    public function handle(Logout $event): void
    {
        if($event->user){
            $user = User::find($event->user->id);
            if($user){
                activity('auth')
                ->causedBy($user)
                ->event('logged_out')
                ->log('auth_attempt');
            }
        }
    }
}
