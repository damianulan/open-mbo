<?php

use App\Enums\MBO\CampaignStage;

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
            'mail_catchall_enabled' => 'Przekierowywanie wiadomości',
            'mail_catchall_receiver' => 'Przekieruj na adres',
        ],
    ],

    'placeholders' => [
        'choose_date' => 'Wybierz datę',
        'choose_birthdate' => 'Wybierz datę',
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
        CampaignStage::COMPLETED->value => 'Ocena zakończona',
        CampaignStage::TERMINATED->value => 'Proces przerwany',
        CampaignStage::CANCELED->value => 'Proces odwołany',
        CampaignStage::IN_PROGRESS->value => 'Proces w toku',
        CampaignStage::PENDING->value => 'Oczekuje na rozpoczęcie pomiaru',
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
        'supervisors' => 'Bezpośredni przełożeni',
        'roles' => 'Role systemowe',
    ],

    'objectives' => [
        'category' => 'Kategoria',
        'name' => 'Nazwa celu',
        'description' => 'Opis celu',
        'draft' => 'Wersja robocza',
        'deadline' => 'Termin realizacji',
        'weight' => 'Waga celu',
        'type' => 'Typ celu',
        'expected' => 'Oczekiwany wynik',
        'award' => 'Punkty nagrody',
        'info' => [
            'deadline' => 'Po upłynięciu tej daty, cel przypisany do użytkownika zostanie automatycznie oznaczony jako zaliczony lub niezaliczony.',
            'weight' => 'Określ jaki udział ma ten cel w całej kampanii. Suma wag wszystkich celów nie może przekraczać wartości <strong>1</strong>.',
            'expected' => 'Określ minimalny wynik potrzebny do zaliczenia celu. W razie nieosiągnięcia wyniku, Administratorzy nadal będą mogli wymusić zaliczenie celu.',
            'award' => 'W razie zaliczenia celu, na konto użytkownika wpadną określone tutaj punkty.',
            'draft' => 'Cel w wersji roboczej nie zostanie udostępniony do realizacji, jest także wyłączony z raportowania.',
        ],
    ],
];
