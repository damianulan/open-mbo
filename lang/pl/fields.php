<?php

use App\Enums\Users\Gender;

return [
    // User & common column Fields
    'firstname' => 'Imię',
    'lastname' => 'Nazwisko',
    'firstname_lastname' => 'Imię i nazwisko',
    'email' => 'E-mail',
    'password' => 'Hasło',
    'gender' => [
        Gender::MALE->value => 'Mężczyzna',
        Gender::FEMALE->value => 'Kobieta',
        Gender::OTHER->value => 'Inna',
    ],

    // Miscellaneous
    'action' => 'Akcje',
    'name' => 'Nazwa',
    'title' => 'Tytuł',
    'category' => 'Kategoria',


    'created_at' => 'Utworzono',
    'updated_at' => 'Zaktualizowano',


];
