<?php

use App\Enums\Users\Gender;

return [
    // User & common column Fields
    'firstname' => 'Imię',
    'lastname' => 'Nazwisko',
    'firstname_lastname' => 'Imię i nazwisko',
    'email' => 'E-mail',
    'login' => 'Login',
    'password' => 'Hasło',
    'status' => 'Status',
    'stage' => 'Etap',

    // Miscellaneous
    'action' => 'Akcje',
    'name' => 'Nazwa',
    'title' => 'Tytuł',
    'category' => 'Kategoria',
    'position' => 'Stanowisko',

    'created_at' => 'Utworzono',
    'updated_at' => 'Zaktualizowano',

    'quote_authored' => ' napisał(a)',
    'quote_at' => 'o',

    // Enumerations
    'gender' => [
        Gender::MALE => 'Mężczyzna',
        Gender::FEMALE => 'Kobieta',
        Gender::OTHER => 'Inna',
    ],

    'type_of_contract' => [
        'uop' => 'Umowa o pracę',
        'uod' => 'Umowa o dzieło',
        'uz' => 'Umowa zlecenie',
        'b2b' => 'B2B',
    ],
];
