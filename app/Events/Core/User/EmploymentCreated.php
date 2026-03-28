<?php

namespace App\Events\Core\User;

use App\Models\Business\UserEmployment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmploymentCreated
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public UserEmployment $employment,
    ) {}
}
