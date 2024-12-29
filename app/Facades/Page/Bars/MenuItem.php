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
    private $routeDirectiveStrict = false;
    protected $icon = null;
    protected $disabled = false;
    protected $visible = true;

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
        if($this->route){
            if($this->routeDirectiveStrict){
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
     * User is required to be assigned to ANY of the given permissions, in order to view menu element.
     */
    public function permission(... $slug): self
    {
        $this->visible = false;
        foreach($slug as $s){
            if(!auth()->user()->hasPermissionTo($s)){
                $this->visible = true;
            }
        }

        return $this;
    }

    /**
     * User is required to be assigned to at least one of the given roles, in order to view menu element.
     */
    public function role(... $slug): self
    {
        if(!auth()->user()->hasAnyRole($slug)){
            $this->visible = false;
        }
        return $this;
    }

}
