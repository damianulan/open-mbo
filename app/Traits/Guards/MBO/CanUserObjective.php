<?php

namespace App\Traits\Guards\MBO;

use App\Enums\MBO\UserObjectiveStatus;
use Illuminate\Support\Facades\Auth;

/**
 * @var \App\Models\MBO\UserObjective $this
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
        return $this->canBeEvaluated() && $this->status !== UserObjectiveStatus::FAILED;
    }

    public function canBePassed(): bool
    {
        return $this->canBeEvaluated() && $this->status !== UserObjectiveStatus::PASSED;
    }
}
