<?php

namespace App\Support\Notifications\Contracts;

use Illuminate\Support\Collection;

interface QueueOnCondition
{
    /**
     * Only sends notification when given condition is met.
     */
    public function condition(): bool;

    /**
     * Return a collection of notifiable receivers.
     * Here also declare global properties, that are needed in notifications
     */
    public function receivers(): Collection;
}
