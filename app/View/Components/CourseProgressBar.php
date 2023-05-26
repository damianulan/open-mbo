<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Courses\Course;

class CourseProgressBar extends Component
{

    private $colors = [
        'in_progress' => '--bs-warning',
        'ungraded' => '--bs-danger',
        'completed' => '--bs-success'
    ];

    public $color;

    public function __construct(public int $progress, Course $course = null, string $state = 'auto', array $options = [])
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
        return view('components.utilities.course_progressbar');
    }
}