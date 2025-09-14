<?php

use App\Enums\MBO\CampaignStage;

return [

    'generic' => [
        'password' => 'Hasło',
        'login' => 'Login',
        'email' => 'E-mail',
    ],

    'version' => [
        'stable' => 'Najnowsza stabilna wersja',
        'non-stable' => 'Najnowsza wersja testowa',
        'dev' => 'Najnowsza wersja deweloperska',
    ],

    'settings' => [
        'general' => [
            'site_name' => 'Nazwa witryny',
            'theme' => 'Szablon',
            'lang' => 'Język aplikacji',
            'release' => 'Wersja aplikacji',
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

        'mbo' => [
            'enabled' => 'Moduł MBO włączony',
            'campaigns_enabled' => 'Kampanie pomiarowe',
            'campaigns_manual' => 'Tryb ręczny w kampaniach',
            'campaigns_bonus' => 'Bonus dla kampanii',
            'objectives_autofail' => 'Automatyczne oznaczanie przedawnionych celów jako niezaliczone',
            'rewards' => 'Punkty nagrody',
            'rewards_proportional' => 'Przeliczaj punkty nagrody proporcjonalnie do rozliczenia',
            'manipulate_rewards' => 'Możliwość edycji przeliczonych punktów nagrody',
            'failed_rewards' => 'Przyznawaj punkty nagrody dla niezaliczonych celów',
            'rewards_min_evaluation' => 'Minimalny wynik oceny celu',
            'rewards_points_exchange' => 'Przeliczanie punktów nagrody',
            'rewards_currency' => 'Waluta nagrody',

            'info' => [
                'enabled' => 'Włącza moduł MBO',
                'campaigns_enabled' => 'Włącza kampanie pomiarowe',
                'campaigns_manual' => 'Włącza tryb ręczny w kampaniach',
                'rewards' => 'Włącza punkty nagrody',
                'min_evaluation' => 'Minimalny wynik procentowy potrzebny do otrzymania punktów nagrody. Punkty nagrody będą przeliczane proporcjonalnie powyżej zadeklarowanej wartości. Aby wyłączyć tę funkcję, ustaw wartość na 0.',
                'reward_points_exchange' => 'Stosunek jednego punktu nagrody do jednego punktu w wybranej walucie',
                'reward_currency' => 'Waluta przyznawania nagrody',
            ],
        ],
    ],

    'placeholders' => [
        'choose' => 'Wybierz...',
        'choose_date' => 'Wybierz datę',
        'choose_birthdate' => 'Wybierz datę',
        'choose_time' => 'Wybierz godzinę',
        'choose_datetime' => 'Wybierz datę oraz godzinę',
        'choose_daterange_from' => 'Wybierz datę od...',
        'choose_daterange_to' => 'Wybierz datę do...',
    ],

    'from' => '[OD]',
    'to' => '[DO]',

    'campaigns' => [
        'name' => 'Nazwa kampanii',
        'period' => 'Okres pomiaru',
        'description' => 'Opis',

        'date_start' => 'Data rozpoczęcia pomiaru',
        'date_end' => 'Data zakończenia pomiaru',

        'stages' => [
            CampaignStage::DEFINITION => 'Tworzenie strategii i określanie celów',
            CampaignStage::DISPOSITION => 'Dysponowanie celów przez kierowników zespołów',
            CampaignStage::REALIZATION => 'Realizacja celów',
            CampaignStage::EVALUATION => 'Ewaluacja celów i ocena pracowników przez kierowników',
            CampaignStage::SELF_EVALUATION => 'Samoocena pracowników',
            CampaignStage::COMPLETED => 'Ocena zakończona',
            CampaignStage::TERMINATED => 'Kampania przerwana',
            CampaignStage::CANCELED => 'Kampania odwołana',
            CampaignStage::IN_PROGRESS => 'Kampania w toku',
            CampaignStage::PENDING => 'Oczekuje na rozpoczęcie pomiaru',
        ],

        'info' => [
            'period' => 'Wprowadź unikalny reprezentatywny okres pomiaru, np. dla pomiaru co kwartał: 2023 Q3.',
            CampaignStage::DEFINITION => 'Tworzenie strategii i określanie celów',
            CampaignStage::DISPOSITION => 'Dysponowanie celów przez kierowników zespołów',
            CampaignStage::REALIZATION => 'Realizacja celów',
            CampaignStage::EVALUATION => 'Ewaluacja celów i ocena pracowników przez kierowników',
            CampaignStage::SELF_EVALUATION => 'Samoocena pracowników',
            CampaignStage::COMPLETED => 'Ocena zakończona',
            CampaignStage::TERMINATED => 'Kampania przerwana',
            CampaignStage::CANCELED => 'Kampania odwołana',
            CampaignStage::IN_PROGRESS => 'Kampania w toku',
            CampaignStage::PENDING => 'Oczekuje na rozpoczęcie pomiaru',
            'draft' => 'Kampania będzie widoczna tylko dla administratorów i nie zostanie uruchomiona automatycznie.',
            'manual' => 'Przejście pomiędzy etapami nie będzie uzależnione od dat, a od podjęcia akcji przez administratora. Opcję tą można także włączyć w trakcie trwania kampanii.',
        ],

        'coordinators' => 'Koordynatorzy kampanii',
        'draft' => 'Przechowuj jako wersję roboczą',
        'manual' => 'Tryb ręczny',

        'users' => [
            'add' => 'Dodaj użytkowników',
        ],

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

    'mbo' => [
        'objectives' => [
            'category' => 'Kategoria',
            'template' => 'Szablon celu',
            'name' => 'Nazwa celu',
            'description' => 'Opis celu',
            'draft' => 'Wersja robocza',
            'deadline' => 'Termin realizacji',
            'deadline_to' => 'Termin realizacji :term',
            'weight' => 'Waga celu',
            'status' => 'Status celu',
            'type' => 'Typ celu',
            'expected' => 'Oczekiwany wynik',
            'award' => 'Punkty nagrody',
            'users' => [
                'add' => 'Dodaj użytkowników',
                'realization' => 'Obecna realizacja celu',
                'evaluation' => 'Wartość rozliczenia celu [%]',
                'info' => [
                    'realization' => 'Wskaż numeryczną wartość realizacji celu. Jeśli przy tworzeniu celu podano oczekwiany wynik, wartość rozliczenia celu zostanie wyliczona automatycznie.',
                    'evaluation' => 'Wskaż wartość procentową realizacji celu. Jeśli przy tworzeniu celu podano oczekwiany wynik, wartość tego rozliczenia celu zostanie wyliczona automatycznie.',
                ],
            ],
            'info' => [
                'deadline' => 'Po upłynięciu tej daty, cel przypisany do użytkownika zostanie automatycznie oznaczony jako zaliczony lub niezaliczony.',
                'weight' => 'Określ jaki wagowy udział ma ten cel w całej kampanii.',
                'expected' => 'Określ minimalny wynik potrzebny do zaliczenia celu. W razie nieosiągnięcia wyniku, Administratorzy nadal będą mogli wymusić zaliczenie celu.',
                'award' => 'W razie zaliczenia celu, na konto użytkownika wpadną określone tutaj punkty.',
                'draft' => 'Cel w wersji roboczej nie zostanie udostępniony do realizacji, jest także wyłączony z raportowania.',
            ],
        ],
        'categories' => [
            'name' => 'Nazwa kategorii',
            'template_count' => 'Powiązane szablony',
            'shortname' => 'Unikalny identyfikator kategorii',
            'description' => 'Opis kategorii',
            'coordinators' => 'Koordynatorzy kategorii',
        ],
    ],
];
