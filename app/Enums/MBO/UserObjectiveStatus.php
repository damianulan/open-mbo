<?php

namespace App\Enums\MBO;

enum UserObjectiveStatus: string
{
    case UNSTARTED = 'unstarted';
    case PROGRESS = 'progress';
    case COMPLETED = 'completed';
    case PASSED = 'passed';
    case FAILED = 'failed';

    public static function values()
    {
        $collection = array();
        foreach(self::cases() as $case){
            $collection[] = $case->value;
        }
        return $collection;
    }
}
