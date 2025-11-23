<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Pagination extends Seeder
{
    public static function list(): array
    {
        return [
            'previous' => [
                'pl' => '&laquo; Poprzednia',
            ],
            'next' => [
                'pl' => 'Następna &raquo;',
            ],
            'showing' => [
                'pl' => 'Wyświetlono',
            ],
            'to' => [
                'pl' => ' - ',
            ],
            'of' => [
                'pl' => 'z',
            ],
            'results' => [
                'pl' => 'wyników',
            ],
        ];
    }
}
