<?php

namespace App\Enums\MBO;

enum CampaignStage: string
{
    case PENDING = 'pending';
    case DEFINITION = 'definition';
    case DISPOSITION = 'disposition';
    case REALIZATION = 'realization';
    case EVALUATION = 'evaluation';
    case SELF_EVALUATION = 'self_evaluation';

    // additional
    case COMPLETION = 'completion'; // case when process is finished in time
    case TERMINATION = 'termination'; // case when process has been terminated after it has started

    public static function values()
    {
        $collection = array();
        foreach(self::cases() as $case){
            $collection[] = $case->value;
        }
        return $collection;
    }
}
