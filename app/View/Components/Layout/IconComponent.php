<?php

namespace App\View\Components\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IconComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $key,
        public int $ml = 0,
        public int $mr = 0,
        public array $classes = [],
        public bool $bi = false
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->bi) {
            $this->classes[] = 'bi';
        }
        if ($this->ml > 0) {
            $this->classes[] = 'ms-' . $this->ml;
        }
        if ($this->mr > 0) {
            $this->classes[] = 'me-' . $this->mr;
        }

        $classes = implode(' ', $this->classes);
        if (!empty($classes)) {
            $classes = ' ' . $classes;
        }
        return '<i class="bi-' . $this->key . $classes . '"></i>';
    }
}
