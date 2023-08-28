<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Elearning\Course;

class CardProgressBar extends Component
{

    private $colors = [
        'in_progress' => '--bs-secondary',
        'ungraded' => '--bs-danger',
        'completed' => '--bs-success'
    ];

    public $color;

    public function __construct(public int $progress, string $state = 'auto', array $options = [])
    {
        if($progress > 0 && $progress < 100){
            $this->color = $this->colors['in_progress'];
        } elseif ($progress === 100) {
            $this->color = $this->colors['completed'];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.utilities.card_progressbar');
    }
}
