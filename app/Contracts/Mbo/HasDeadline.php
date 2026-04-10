<?php

namespace App\Contracts\Mbo;

interface HasDeadline
{
    public function isAfterDeadline(): bool;

    public function isOverdued(): bool;
}
