<?php

namespace App\Events\Core\User;

use App\Models\Business\UserEmployment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmploymentUpdated
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public UserEmployment $employment
    ) {}
}
