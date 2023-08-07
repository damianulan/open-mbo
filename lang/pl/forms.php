<?php

use App\Enums\ProcessStage;

return [

    'generic' => [
        'password' => 'Hasło',

    ],

    'settings' => [
        'general' => [
            'site_name' => 'Nazwa witryny',
            'theme' => 'Szablon',
            'lang' => 'Język aplikacji',
        ],
        'server' => [
            'mail_host' => 'Adres serwera',
            'mail_port' => 'Port',
            'mail_username' => 'Użytkownik',
            'mail_encryption' => 'Metoda szyfrowania',
            'mail_from_address' => 'Wysyłaj z adresu',
            'mail_from_name' => 'Wysyłaj jako (nazwa)',
        ],
    ],

    'placeholders' => [
        'choose_date' => 'Wybierz datę',
        'choose_time' => 'Wybierz godzinę',
        'choose_datetime' => 'Wybierz datę oraz godzinę',
        'choose_daterange_from' => 'Wybierz datę od...',
        'choose_daterange_to' => 'Wybierz datę do...',
    ],

    'process' => [
        'name' => 'Nazwa procesu',
        'period' => 'Okres pomiaru',
        'description' => 'Opis',
        ProcessStage::DEFINITION->value => 'Tworzenie strategii i określanie celów przez kierownictwo',
        ProcessStage::DISPOSITION->value => 'Dysponowanie celów przez kierowników zespołów',
        ProcessStage::REALIZATION->value => 'Realizacja celów',
        ProcessStage::EVALUATION->value => 'Ewaluacja celów i ocena pracowników przez kierowników',
        ProcessStage::SELF_EVALUATION->value => 'Samoocena pracowników',
        ProcessStage::COMPLETION->value => 'Ocena zakończona',
        ProcessStage::TERMINATION->value => 'Proces ',
        'draft' => 'Przechowuj jako wersję roboczą',
        'manual' => 'Tryb ręczny',

    ],

    'users' => [
        'avatar' => 'Zdjęcie profilowe',
        'firstname' => 'Imię',
        'lastname' => 'Nazwisko',
        'email' => 'E-mail',
        'gender' => 'Płeć',
        'birthday' => 'Data urodzenia',

    ]
];
