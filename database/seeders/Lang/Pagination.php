<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Pagination extends Seeder
{
    public static function list(): array
    {
        return array(
            'previous' => array(
                'pl' => '&laquo; Poprzednia',
            ),
            'next' => array(
                'pl' => 'Następna &raquo;',
            ),
            'showing' => array(
                'pl' => 'Wyświetlono',
            ),
            'to' => array(
                'pl' => ' - ',
            ),
            'of' => array(
                'pl' => 'z',
            ),
            'results' => array(
                'pl' => 'wyników',
            ),
        );
    }
}
