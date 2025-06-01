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

    // Miscellaneous
    'action' => 'Akcje',
    'name' => 'Nazwa',
    'title' => 'Tytuł',
    'category' => 'Kategoria',

    'created_at' => 'Utworzono',
    'updated_at' => 'Zaktualizowano',


    // Enumerations
    'gender' => [
        Gender::MALE => 'Mężczyzna',
        Gender::FEMALE => 'Kobieta',
        Gender::OTHER => 'Inna',
    ],

];
