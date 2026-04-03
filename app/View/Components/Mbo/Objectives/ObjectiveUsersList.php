<?php

namespace App\View\Components\Mbo\Objectives;

use App\Models\Mbo\Objective;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ObjectiveUsersList extends Component
{
    public $emptyInfo;

    public $userAssignments;

    public function __construct(public Objective $objective, public string $status = 'all')
    {
        $this->emptyInfo = __('mbo.info.no_users_added');
        if ($status === 'all') {
            $this->userAssignments = $objective->user_objectives()->with(['user.profile', 'user.roles', 'campaign'])->get();
        } elseif ($status === 'progress') {
            $this->userAssignments = $objective->user_objectives()->whereNotEvaluated()->with(['user.profile', 'user.roles', 'campaign'])->get();
            $this->emptyInfo = __('mbo.info.objective_not_evaluated_no_users');
        } elseif ($status === 'passed') {
            $this->userAssignments = $objective->user_objectives()->wherePassed()->with(['user.profile', 'user.roles', 'campaign'])->get();
            $this->emptyInfo = __('mbo.info.objective_passed_no_users');
        } elseif ($status === 'failed') {
            $this->userAssignments = $objective->user_objectives()->whereFailed()->with(['user.profile', 'user.roles', 'campaign'])->get();
            $this->emptyInfo = __('mbo.info.objective_failed_no_users');
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.mbo.objectives.objective-users-list');
    }
}
