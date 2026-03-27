<?php

namespace App\Traits\Guards\Mbo;

use App\Enums\Mbo\UserObjectiveStatus;
use App\Models\Mbo\UserObjective;
use Illuminate\Support\Facades\Auth;

/**
 * @var UserObjective $this
 *
 * @author Damian Ułan <damian.ulan@protonmail.com>
 * @copyright 2025 damianulan
 */
trait CanUserObjective
{
    /**
     * Check whether campaign can be evaluated whether by a superior user or by the user himself.
     */
    public function canBeEvaluated(): bool
    {
        return Auth::user()->can('evaluate', $this) || Auth::user()->can('self_evaluate', $this);
    }

    public function canBeFailed(): bool
    {
        return $this->canBeEvaluated() && UserObjectiveStatus::FAILED->value !== $this->status;
    }

    public function canBePassed(): bool
    {
        return $this->canBeEvaluated() && UserObjectiveStatus::PASSED->value !== $this->status;
    }
}
