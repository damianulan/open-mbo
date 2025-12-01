<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Charts extends Seeder
{
    public static function list(): array
    {
        return array(
            'user_campaign_evaluation' => array(
                'pl' => 'Podsumowanie rozliczenia celów',
            ),
            'user_campaign_completion' => array(
                'pl' => 'Wagowa realizacja celów',
            ),
        );
    }
}
