<?php

namespace App\Facades\Page\Bars;

use Illuminate\Support\Facades\Route;

class MenuItem
{
    public $id;
    protected $title;
    protected $route = null;
    protected $link;
    protected $parentRoute = null;
    protected $icon = null;
    protected $disabled = false;

    public static function make(string $id): self
    {
        $instance = new self();
        $instance->id = $id;
        return $instance;
    }

    public function setRoute(string $route): self
    {
        if(Route::has($route)){
            $this->route = $route;

            if (strpos($route, '.') !== false) {
                $this->parentRoute = substr($route, 0, strpos($route, '.')) . ".*";
            } else {
                $this->parentRoute = $route;
            }

        } else {
            $this->disabled = true;
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
        if($iconname){
            $this->icon = '<i class="bi bi-'.$iconname.'"></i>';
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
        return $this->disabled||!$this->route ? true:false;
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
        if($this->parentRoute){
            return request()->routeIs($this->parentRoute);
        }
        return false;
    }

    public function link()
    {
        return $this->route ? route($this->route):'#';
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

}
