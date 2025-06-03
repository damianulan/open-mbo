<?php

namespace App\Support\Page\Bars;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class MenuItem
{
    public $id;
    protected $title;
    protected $route = null;
    protected $link;
    protected $parentRoute = null;
    private $routeDirectiveStrict = false;
    protected $icon = null;
    protected $disabled = false;
    protected $visible = true;

    private $blockVisibility = false;

    public static function make(string $id): self
    {
        $instance = new self();
        $instance->id = $id;
        return $instance;
    }

    public function setRoute(string $route): self
    {
        if (Route::has($route)) {
            $this->route = $route;
        } else {
            $this->disabled = true;
        }

        return $this;
    }

    public function useStrictRoutes()
    {
        $this->routeDirectiveStrict = true;
        return $this;
    }

    public function generateParentRoute(): self
    {
        if ($this->route) {
            if ($this->routeDirectiveStrict) {
                if (strrpos($this->route, '.') !== false) {
                    $this->parentRoute = substr($this->route, 0, strrpos($this->route, '.')) . ".*";
                } else {
                    $this->parentRoute = $this->route;
                }
            } else {
                if (strpos($this->route, '.') !== false) {
                    $this->parentRoute = substr($this->route, 0, strpos($this->route, '.')) . ".*";
                } else {
                    $this->parentRoute = $this->route;
                }
            }
        }
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setIcon(string $iconname): self
    {
        if ($iconname) {
            $this->icon = '<i class="bi bi-' . $iconname . '"></i>';
        }
        return $this;
    }

    public function disable(): self
    {
        $this->disabled = true;
        return $this;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function disabled(): bool
    {
        return $this->disabled || !$this->route ? true : false;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function active(): bool
    {
        if ($this->parentRoute) {
            return request()->routeIs($this->parentRoute);
        }
        return false;
    }

    public function link()
    {
        return $this->route ? route($this->route) : '#';
    }

    public function icon(): ?string
    {
        return $this->icon ?? '';
    }

    public function render()
    {
        return view('components.menus.item', [
            'item' => $this,
        ])->render();
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function hide(): self
    {
        $this->visible = false;
        return $this;
    }

    /**
     * Use this method to check if given setting allows to view menu element.
     * Setting should represent a boolean value.
     */
    public function settings(...$setting): self
    {
        foreach ($setting as $s) {
            $set = (bool) setting($s) ?? false;
            if (!$set) {
                if (!$this->blockVisibility) {
                    $this->visible = false;
                    $this->blockVisibility = true;
                }
            }
        }

        return $this;
    }

    /**
     * User is required to be assigned to ANY of the given permissions, in order to view menu element.
     */
    public function permission(...$slug): self
    {
        $this->visible = false;
        foreach ($slug as $s) {
            if (!$this->blockVisibility) {
                if (user()->hasPermissionTo($s)) {
                    $this->visible = true;
                } else {
                    $this->visible = false;
                    $this->blockVisibility = true;
                }
            }
        }

        return $this;
    }

    /**
     * User is required to be assigned to at least one of the given roles, in order to view menu element.
     */
    public function role(...$slug): self
    {
        if (!is_array($slug)) {
            $slug = array($slug);
        }
        if (!auth()->user()->hasAnyRoles($slug)) {
            $this->visible = false;
        }
        return $this;
    }
}
