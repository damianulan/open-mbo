<?php

namespace App\Contracts\MBO;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Relation;

interface AssignsPoints
{
    public function points(): Relation|Attribute|null;

    public function calculatePoints(): float;
}
