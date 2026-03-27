<?php

namespace App\Listeners\Business;

use App\Events\Core\User\EmploymentCreated;
use App\Events\Core\User\EmploymentDeleted;
use App\Events\Core\User\EmploymentUpdated;
use App\Factories\Users\UserStatusFactory;
use App\Models\Business\UserEmployment;
use App\Models\Core\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserEmploymentSaved implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(EmploymentCreated|EmploymentUpdated|EmploymentDeleted $event): void
    {
        /** @var UserEmployment $employment */
        $employment = $event->employment;
        /** @var User $user */
        $user = $employment->user;

        if ($user) {
            $user->setStatus(UserStatusFactory::make($user));
        }
    }
}
