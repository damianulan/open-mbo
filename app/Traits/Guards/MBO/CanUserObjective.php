<?php

namespace App\Traits\Guards\MBO;

use App\Enums\MBO\UserObjectiveStatus;

trait CanUserObjective
{
    public function canBeEvaluated(): bool
    {
        return in_array($this->status, UserObjectiveStatus::finished());
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
