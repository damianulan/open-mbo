<?php

namespace App\Listeners\Activity;

use App\Models\Core\User;
use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        if ($event->user) {
            $user = User::find($event->user->id);
            if ($user) {
                activity('auth')
                    ->causedBy($user)
                    ->event('logged_out')
                    ->log(__('logging.description.auth_logout'));
            }
        }
    }
}
