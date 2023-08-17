<?php

use App\Enums\CampaignStage;

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

    'campaigns' => [
        'name' => 'Nazwa kampanii',
        'period' => 'Okres pomiaru',
        'description' => 'Opis',
        CampaignStage::DEFINITION->value => 'Tworzenie strategii i określanie celów przez kierownictwo',
        CampaignStage::DISPOSITION->value => 'Dysponowanie celów przez kierowników zespołów',
        CampaignStage::REALIZATION->value => 'Realizacja celów',
        CampaignStage::EVALUATION->value => 'Ewaluacja celów i ocena pracowników przez kierowników',
        CampaignStage::SELF_EVALUATION->value => 'Samoocena pracowników',
        CampaignStage::COMPLETION->value => 'Ocena zakończona',
        CampaignStage::TERMINATION->value => 'Proces ',
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

    ],

    'objectives' => [
        'category' => 'Kategoria',
        'name' => 'Nazwa celu',
        'description' => 'Opis celu',
        'goal' => 'Oczekiwany poziom realizacji',
        'draft' => 'Wersja robocza',
    ],
];
