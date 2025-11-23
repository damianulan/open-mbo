<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Fields extends Seeder
{
    public static function list(): array
    {
        return [
            'firstname' => [
                'pl' => 'Imię',
            ],
            'lastname' => [
                'pl' => 'Nazwisko',
            ],
            'firstname_lastname' => [
                'pl' => 'Imię i nazwisko',
            ],
            'email' => [
                'pl' => 'E-mail',
            ],
            'login' => [
                'pl' => 'Login',
            ],
            'password' => [
                'pl' => 'Hasło',
            ],
            'status' => [
                'pl' => 'Status',
            ],
            'stage' => [
                'pl' => 'Etap',
            ],
            'action' => [
                'pl' => 'Akcje',
            ],
            'name' => [
                'pl' => 'Nazwa',
            ],
            'title' => [
                'pl' => 'Tytuł',
            ],
            'category' => [
                'pl' => 'Kategoria',
            ],
            'position' => [
                'pl' => 'Stanowisko',
            ],
            'created_at' => [
                'pl' => 'Utworzono',
            ],
            'updated_at' => [
                'pl' => 'Zaktualizowano',
            ],
            'quote_authored' => [
                'pl' => ' napisał(a)',
            ],
            'quote_at' => [
                'pl' => 'o',
            ],
            'gender.m' => [
                'pl' => 'Mężczyzna',
            ],
            'gender.f' => [
                'pl' => 'Kobieta',
            ],
            'gender.o' => [
                'pl' => 'Inna',
            ],
            'type_of_contract.uop' => [
                'pl' => 'Umowa o pracę',
            ],
            'type_of_contract.uod' => [
                'pl' => 'Umowa o dzieło',
            ],
            'type_of_contract.uz' => [
                'pl' => 'Umowa zlecenie',
            ],
            'type_of_contract.b2b' => [
                'pl' => 'B2B',
            ],
        ];
    }
}
