<?php

namespace App\Traits;

use App\Models\Core\RoleContext;

trait Contexts
{
    protected static function bootContexts()
    {
        static::creating(function ($model) {
            
        });
    }

    public function context()
    {
        return $this->morphOne(RoleContext::class, 'subject');
    }
}
