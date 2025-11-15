<?php

namespace App\Contracts\MBO;

interface HasDeadline
{
    /**
     * Is after deadline, or deadline is not set.
     */
    public function isAfterDeadline(): bool;

    /**
     * Is deadline overdued. If deadline is not set, it should return false.
     */
    public function isOverdued(): bool;
}
