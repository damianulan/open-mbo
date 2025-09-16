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
    public function canBeEvaluated(): bool
    {
        return in_array($this->status, UserObjectiveStatus::finished()) && Auth::user()->can('evaluate', $this);
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
