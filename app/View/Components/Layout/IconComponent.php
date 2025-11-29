<?php

namespace App\View\Components\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IconComponent extends Component
{
    /**
     * Create a new component instance.
     * @param string $key
     * @param int $ml
     * @param int $mr
     * @param string $classes
     * @param bool $bi
     */
    public function __construct(
        public string $key,
        public int $ml = 0,
        public int $mr = 0,
        public string $classes = '',
        public bool $bi = false
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->bi) {
            $this->classes .= ' bi';
        }
        if ($this->ml > 0) {
            $this->classes .= ' ms-' . $this->ml;
        }
        if ($this->mr > 0) {
            $this->classes .= ' me-' . $this->mr;
        }

        if ( ! empty($this->classes)) {
            $this->classes = ' ' . $this->classes;
        }

        return '<i class="bi-' . $this->key . ' ' . trim($this->classes) . '"></i>';
    }
}
