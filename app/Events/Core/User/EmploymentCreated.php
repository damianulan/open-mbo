<?php

namespace App\Events\Core\User;

use App\Models\Business\UserEmployment;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmploymentCreated implements ShouldDispatchAfterCommit
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     * @param UserEmployment $employment
     */
    public function __construct(
        public UserEmployment $employment
    ) {}
}
