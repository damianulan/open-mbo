<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Models extends Seeder
{
    public static function list(): array
    {
        return [
            'App\Models\Core\User' => [
                'pl' => 'Użytkownik',
            ],
            'App\Models\MBO\Campaign' => [
                'pl' => 'Kampania MBO',
            ],
            'App\Models\MBO\Objective' => [
                'pl' => 'Cel',
            ],
        ];
    }
}
