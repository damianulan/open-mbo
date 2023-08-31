<?php

namespace App\Models\MBO\Awards;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;

class UserAwards extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'user_id',
        'award',
    ];
}
