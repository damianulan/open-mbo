<?php

namespace App\Support\UI\Page\Navigation;

use App\Support\UI\Page\Navigation\Contracts\NavbarContract;
use App\Support\UI\Page\Navigation\Traits\HasNavItems;
use Illuminate\Support\Collection;

class PageNav implements NavbarContract
{
    use HasNavItems;

    public $id;

    public $classes = [];

    public static function boot(string $id, array $items = []): self
    {
        $instance = new self;
        $instance->id = $id;
        $instance->items = new Collection;

        if (! empty($items)) {
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
        if (! empty($class)) {
            $this->classes[] = $class;
        }

        return $this;
    }

    public function render(): string
    {
        return view('components.menus.menubar', [
            'menubar' => $this,
        ])->render();
    }
}
