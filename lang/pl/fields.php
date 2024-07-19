<?php

use App\Enums\Users\Gender;
use App\Enums\MBO\ObjectiveType;

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

        Gender::MALE->value => 'Mężczyzna',
        Gender::FEMALE->value => 'Kobieta',
        Gender::OTHER->value => 'Inna',
    ],

    // Roles
    'roles' => [
        'root' => 'Root',
        'support' => 'Helpdesk',
        'admin' => 'Administrator',
        'admin_mbo' => 'Administrator MBO',
        'manager' => 'Menadżer',
        'supervisor' => 'Przełożony',
        'employee' => 'Pracownik',
    ],
];
