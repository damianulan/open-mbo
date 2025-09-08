<?php

namespace App\Contracts\MBO;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface AssignsPoints
{
    public function points(): MorphOne;

    public function calculatePoints(): float;
}
