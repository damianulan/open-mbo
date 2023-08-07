<?php

namespace App\Enums\Users;

enum Gender: string
{
    case MALE = 'm';
    case FEMALE = 'f';
    case OTHER = 'o';

    public static function values()
    {
        $collection = array();
        foreach(self::cases() as $case){
            $collection[] = $case->value;
        }
        return $collection;
    }
}
