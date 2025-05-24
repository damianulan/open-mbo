<?php

namespace App\View\Components\MBO\Objectives;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ObjectiveUsersList extends Component
{
    public $emptyInfo;
    /**
     * Create a new component instance.
     */
    public function __construct(public $userAssignments)
    {
        $this->emptyInfo = __('mbo.info.no_users_added');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mbo.objectives.objective-users-list');
    }
}
