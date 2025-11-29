<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Fields extends Seeder
{
    public static function list(): array
    {
        return array(
            'firstname' => array(
                'pl' => 'Imię',
            ),
            'lastname' => array(
                'pl' => 'Nazwisko',
            ),
            'firstname_lastname' => array(
                'pl' => 'Imię i nazwisko',
            ),
            'email' => array(
                'pl' => 'E-mail',
            ),
            'login' => array(
                'pl' => 'Login',
            ),
            'password' => array(
                'pl' => 'Hasło',
            ),
            'status' => array(
                'pl' => 'Status',
            ),
            'stage' => array(
                'pl' => 'Etap',
            ),
            'action' => array(
                'pl' => 'Akcje',
            ),
            'name' => array(
                'pl' => 'Nazwa',
            ),
            'title' => array(
                'pl' => 'Tytuł',
            ),
            'category' => array(
                'pl' => 'Kategoria',
            ),
            'position' => array(
                'pl' => 'Stanowisko',
            ),
            'created_at' => array(
                'pl' => 'Utworzono',
            ),
            'updated_at' => array(
                'pl' => 'Zaktualizowano',
            ),
            'quote_authored' => array(
                'pl' => ' napisał(a)',
            ),
            'quote_at' => array(
                'pl' => 'o',
            ),
            'gender.m' => array(
                'pl' => 'Mężczyzna',
            ),
            'gender.f' => array(
                'pl' => 'Kobieta',
            ),
            'gender.o' => array(
                'pl' => 'Inna',
            ),
            'type_of_contract.uop' => array(
                'pl' => 'Umowa o pracę',
            ),
            'type_of_contract.uod' => array(
                'pl' => 'Umowa o dzieło',
            ),
            'type_of_contract.uz' => array(
                'pl' => 'Umowa zlecenie',
            ),
            'type_of_contract.b2b' => array(
                'pl' => 'B2B',
            ),
        );
    }
}
