<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Charts extends Seeder
{
    public static function list(): array
    {
        return [
            'user_campaign_evaluation' => [
                'pl' => 'Podsumowanie rozliczenia celów',
            ],
            'user_campaign_completion' => [
                'pl' => 'Wagowa realizacja celów',
            ],
        ];
    }
}
