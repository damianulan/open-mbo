<?php

namespace App\Traits;

trait Favouritable
{
    public function favourite_to()
    {
        return $this->morphToMany(static::class, 'subject', 'favourities');
    }
}
