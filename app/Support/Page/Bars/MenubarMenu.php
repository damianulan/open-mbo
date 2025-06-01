<?php

namespace App\Support\Page\Bars;

use Illuminate\Support\Collection;
use App\Support\Page\Bars\MenuItem;

class MenubarMenu
{
    public $id;
    public Collection $items;
    public $classes = [];

    public static function boot(string $id, array $items = []): self
    {
        $instance = new self();
        $instance->id = $id;
        $instance->items = new Collection();

        if (!empty($items)) {
            foreach ($items as $item) {
                if ($item instanceof MenuItem) {
                    if ($item->id && $item->isVisible()) {
                        $item->useStrictRoutes();
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
        return view('components.menus.menubar', [
            'menubar' => $this,
        ])->render();
    }
}
