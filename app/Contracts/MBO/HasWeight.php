<?php

namespace App\Contracts\MBO;

interface HasWeight
{
    public function getWeightAttribute(): float;
}
