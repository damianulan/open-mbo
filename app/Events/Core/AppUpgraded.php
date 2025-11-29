<?php

namespace App\Events\Core;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AppUpgraded
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     * @param string $release
     */
    public function __construct(public string $release) {}
}
