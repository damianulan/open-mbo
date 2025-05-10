<?php

namespace App\View\Components\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TileButton extends Component
{
    public $icon_html = null;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public ?string $id = null,
        public ?string $link = null,
        public ?string $icon = null,
        public string $classes = '',
        public bool $selected = false,
        public bool $enter_icon = true
    ) {
        if ($icon) {
            $this->icon_html = '<i class="bi bi-' . $icon . '"></i>';
        }

        if (empty($link)) {
            $this->link = 'javascript:void(0);';
        } else {
            $this->selected = url()->current() === $this->link;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.tile-button');
    }
}
