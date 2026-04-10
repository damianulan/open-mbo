<?php

namespace App\View\Components\Mbo\Campaign;

use Illuminate\View\Component;
use Illuminate\View\View;

class CardProgressBar extends Component
{
    public $color;

    private $colors = [
        'in_progress' => '--bs-secondary',
        'ungraded' => '--bs-danger',
        'completed' => '--bs-success',
    ];

    public function __construct(public int $progress, bool $failed = false)
    {
        if ($progress > 0 && $progress < 100 && ! $failed) {
            $this->color = $this->colors['in_progress'];
        } elseif ($progress === 100 && ! $failed) {
            $this->color = $this->colors['completed'];
        } else {
            $this->color = $this->colors['ungraded'];
            $progress = 100;
        }
    }

    public function render(): View
    {
        return view('components.utilities.card_progressbar');
    }
}
