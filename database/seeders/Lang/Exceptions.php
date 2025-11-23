<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Exceptions extends Seeder
{
    public static function list(): array
    {
        return [
            'App\Exceptions\MBO\UnableToSetObjectiveRealization' => [
                'pl' => 'Czas na wykonanie celu nie został jeszcze osiągnięty. Realizacja celu nie jest możliwa do ustawienia.',
                'en' => 'The time for the objective has not yet been reached. The objective cannot be set for realization.',
            ],
        ];
    }
}
