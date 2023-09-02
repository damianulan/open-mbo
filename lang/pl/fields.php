<?php

use App\Enums\Users\Gender;
use App\Enums\ObjectiveType;

return [
    // User & common column Fields
    'firstname' => 'Imię',
    'lastname' => 'Nazwisko',
    'firstname_lastname' => 'Imię i nazwisko',
    'email' => 'E-mail',
    'password' => 'Hasło',
    'status' => 'Status',

    // Miscellaneous
    'action' => 'Akcje',
    'name' => 'Nazwa',
    'title' => 'Tytuł',
    'category' => 'Kategoria',


    'created_at' => 'Utworzono',
    'updated_at' => 'Zaktualizowano',


    // Enumerations
    'enums' => [
        ObjectiveType::INDIVIDUAL->value => 'Indywidualny',
        ObjectiveType::TEAM->value => 'Zespołowy',
        ObjectiveType::GLOBAL->value => 'Globalny',

        Gender::MALE->value => 'Mężczyzna',
        Gender::FEMALE->value => 'Kobieta',
        Gender::OTHER->value => 'Inna',
    ],
];
