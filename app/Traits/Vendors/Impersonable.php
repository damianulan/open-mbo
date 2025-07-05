<?php

namespace App\Traits\Vendors;

trait Impersonable
{
    public function isImpersonating(): bool
    {
        $imanager = app('impersonate');

        return $imanager->isImpersonating();
    }

    public function impersonator(): static
    {
        $imanager = app('impersonate');

        return static::find($imanager->getImpersonatorId());
    }
}
