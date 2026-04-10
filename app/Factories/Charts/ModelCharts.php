<?php

namespace App\Factories\Charts;

use Akaunting\Apexcharts\Chart;
use App\Enums\Mbo\UserObjectiveStatus;
use App\Models\Core\User;
use App\Models\Mbo\UserCampaign;
use App\Models\Mbo\UserObjective;

class ModelCharts extends ChartsLib
{
    public function userCampaignEvaluation(UserCampaign $model): Chart
    {
        $this->title = __('charts.user_campaign_evaluation');
        $this->type = 'donut';

        $userObjectives = $model->user_objectives;
        $passed = (clone $userObjectives)->where('status', UserObjectiveStatus::PASSED->value)->count();
        $failed = (clone $userObjectives)->where('status', UserObjectiveStatus::FAILED->value)->count();
        $other = (clone $userObjectives)->whereNotIn('status', UserObjectiveStatus::evaluated())->count();

        return $this->getChart()
            ->setLabels([__('mbo.not_evaluated'), __('mbo.passed'), __('mbo.failed')])
            ->setColors([
                'var(--bs-info)',
                'var(--bs-passed)',
                'var(--bs-failed)',
            ])
            ->setHeight('150')
            ->setDataset('set-1', $this->type, [$other, $passed, $failed]);
    }

    public function userCampaignCompletion(UserCampaign $model): Chart
    {
        $this->title = __('charts.user_campaign_completion');
        $this->type = 'donut';

        $userObjectives = $model->user_objectives;
        $totalWeight = (float) $userObjectives->sum(
            fn (UserObjective $userObjective): float => $userObjective->weight,
        );

        $totalCompleted = (float) $userObjectives
            ->filter(fn (UserObjective $userObjective): bool => $userObjective->isCompleted())
            ->sum(fn (UserObjective $userObjective): float => $userObjective->weight);

        $totalNotCompleted = max(0, $totalWeight - $totalCompleted);

        return $this->getChart()
            ->setLabels([__('mbo.completed'), __('mbo.uncompleted')])
            ->setColors([
                'var(--bs-info)',
                'var(--bs-unstarted)',
            ])
            ->setHeight('150')
            ->setDataset('set-1', $this->type, [$totalCompleted, $totalNotCompleted]);
    }

    public function userPointsGrouped(User $model): Chart
    {
        $this->title = 'User points grouped';
        $this->type = 'donut';

        return $this->getChart()
            ->setLabels([__('mbo.completed'), __('mbo.uncompleted')])
            ->setColors([
                'var(--bs-info)',
                'var(--bs-unstarted)',
            ])
            ->setHeight('150')
            ->setDataset('set-1', $this->type, []);
    }
}
