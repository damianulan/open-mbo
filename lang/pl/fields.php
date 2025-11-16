<?php

use App\Enums\Users\Gender;

return array(
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
    'gender' => array(
        Gender::MALE => 'Mężczyzna',
        Gender::FEMALE => 'Kobieta',
        Gender::OTHER => 'Inna',
    ),

);
