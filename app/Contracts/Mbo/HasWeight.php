<?php

namespace App\Contracts\Mbo;

interface HasWeight
{
    public function getWeightAttribute($value): float;
}
