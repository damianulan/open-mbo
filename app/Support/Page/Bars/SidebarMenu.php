<?php

namespace App\Support\Page\Bars;

use Illuminate\Support\Collection;
use App\Support\Page\Bars\MenuItem;

class SidebarMenu
{
    public $id = 'sidebar';
    public $sitename;
    public Collection $items;
    public $classes = [];

    public static function boot(string $sitename, array $items = []): self
    {
        $instance = new self();
        $instance->sitename = $sitename;
        $instance->items = new Collection();

        if (!empty($items)) {
            foreach ($items as $item) {
                if ($item instanceof MenuItem) {
                    if ($item->id && $item->isVisible()) {
                        $item->generateParentRoute();
                        $instance->items->push($item);
                    }
                }
            }
        }

        return $instance;
    }

    public function addClass(?string $class): self
    {
        if (!empty($class)) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function isNotEmpty(): bool
    {
        return $this->items && $this->items->isNotEmpty();
    }

    public function isEmpty(): bool
    {
        return !$this->items || $this->items->isEmpty();
    }

    public function render()
    {
        return view('components.menus.sidebar', [
            'sidebar' => $this,
        ])->render();
    }
}
