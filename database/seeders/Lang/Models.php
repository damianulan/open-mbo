<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Models extends Seeder
{
    public static function list(): array
    {
        return array(
            'App\Models\Core\User' => array(
                'pl' => 'Użytkownik',
            ),
            'App\Models\MBO\Campaign' => array(
                'pl' => 'Kampania MBO',
            ),
            'App\Models\MBO\Objective' => array(
                'pl' => 'Cel',
            ),
        );
    }
}
