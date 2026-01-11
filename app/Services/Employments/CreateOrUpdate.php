<?php

namespace App\Services\Employments;

use App\Models\Business\UserEmployment;
use Lucent\Services\Service;

final class CreateOrUpdate extends Service
{
    public function handle(): UserEmployment
    {
        $id = $this->employment->id ?? null;
        $employment = UserEmployment::fillFromRequest($id);

        if ($employment->save()) {
            $this->employment = $employment;
        }

        return $employment;
    }
}
