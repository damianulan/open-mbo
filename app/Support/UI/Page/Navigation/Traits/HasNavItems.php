<?php

namespace App\Support\UI\Page\Navigation\Traits;

use Illuminate\Support\Collection;

trait HasNavItems
{
    protected ?Collection $items = null;

    public function hasItems(): bool
    {
        return $this->items && $this->items->isNotEmpty();
    }

    public function getItems(): ?Collection
    {
        return $this->items;
    }
}
