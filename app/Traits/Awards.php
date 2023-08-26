<?php

namespace App\Traits;

use App\Models\MBO\Awards\UserAwards;

trait Awards
{
    /**
     * @return mixed
     */
    public function awards()
    {
        return $this->belongsToMany(UserAwards::class,'users_roles');
    }

}
