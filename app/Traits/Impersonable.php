<?php

namespace App\Traits;

trait Impersonable
{
    private $imanager;

    public function __construct()
    {
        $this->imanager = app('impersonate');
    }

    public function isImpersonating(): bool
    {
        return $this->imanager->isImpersonating();
    }

    public function impersonator(): static
    {
        return static::find($this->imanager->getImpersonatorId());
    }
}
