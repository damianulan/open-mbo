<?php

namespace App\Support\UI\Page\Navigation;

use App\Support\UI\Page\Navigation\Contracts\NavbarContract;
use App\Support\UI\Page\Navigation\Traits\HasNavItems;
use Illuminate\Support\Collection;

class SidebarNav implements NavbarContract
{
    use HasNavItems;

    public $id = 'sidebar';

    public $sitename;

    public $classes = [];

    public static function boot(string $sitename, array $items = []): self
    {
        $instance = new self();
        $instance->sitename = $sitename;
        $instance->items = new Collection();

        if ( ! empty($items)) {
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
        if ( ! empty($class)) {
            $this->classes[] = $class;
        }

        return $this;
    }

    public function isCollapsed(): bool
    {
        return isset($_COOKIE['menu-collapsed']) && true === (bool) $_COOKIE['menu-collapsed'];
    }

    public function render(): string
    {
        return view('components.menus.sidebar', [
            'sidebar' => $this,
        ])->render();
    }
}
