<?php

namespace App\Contracts\MBO;

interface HasDeadline
{
    /**
     * Is after deadline, or deadline is not set.
     *
     * @return bool
     */
    public function isAfterDeadline(): bool;

    /**
     * Is deadline overdued. If deadline is not set, it should return false.
     *
     * @return bool
     */
    public function isOverdued(): bool;
}
