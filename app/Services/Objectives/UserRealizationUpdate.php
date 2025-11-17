<?php

namespace App\Services\Objectives;

use App\Models\MBO\UserObjective;
use Lucent\Services\Service;

class UserRealizationUpdate extends Service
{
    /**
     * Handle the service main logic.
     *
     * @return mixed
     */
    protected function handle(): UserObjective
    {
        $realization = $this->request()->input('realization') ?? null;
        $evaluation = $this->request()->input('evaluation') ?? null;
        $prefix = '';

        if (!$realization && !$evaluation) {
            $prefix = 'self_';
            $realization = $this->request()->input('self_realization') ?? null;
            $evaluation = $this->request()->input('self_evaluation') ?? null;
        }

        if ($realization) {
            $maxRealization = $this->userObjective->objective?->expected ?? null;
            if ($maxRealization) {
                $evaluation = ($realization / $maxRealization) * 100;
            }
        }

        // if (settings('mbo.rewards_min_evaluation') > $evaluation) {
        //     $realization = 0;
        // }

        $this->userObjective->{$prefix . 'realization'} = $realization;
        $this->userObjective->{$prefix . 'evaluation'}  = $evaluation;

        $this->userObjective->update();

        return $this->userObjective;
    }
}
