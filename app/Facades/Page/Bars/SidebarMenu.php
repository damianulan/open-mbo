<?php

namespace App\Facades\Page\Bars;

use Illuminate\Support\Collection;
use App\Facades\Page\Bars\MenuItem;

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

        if(!empty($items)){
            foreach($items as $item){
                if($item instanceof MenuItem){
                    if($item->id && self::hasPermissionTo($item->id)){
                        $instance->items->push($item);
                    }
                }
            }
        }

        return $instance;
    }

    private static function hasPermissionTo(string $item_id): bool
    {
        $can = true;

        switch ($item_id) {
            case 'value':
                # code...
                break;

            default:
                $can = true; // false
                break;
        }

        return $can;
    }

    public function addClass(?string $class): self
    {
        if(!empty($class)){
            $this->classes[] = $class;
        }
        return $this;
    }

    public function render()
    {
        return view('components.menus.sidebar', [
            'sidebar' => $this,
        ])->render();
    }

}
