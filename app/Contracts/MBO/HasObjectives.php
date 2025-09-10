<?php

namespace App\Contracts\MBO;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

interface HasObjectives
{
    public function objectives(): HasMany|HasManyThrough;
}
