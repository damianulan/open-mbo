<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleContext extends Model
{
    use HasFactory;

    protected $table = 'role_contexts';

    public function subject()
    {
        return $this->morphTo();
    }
}
