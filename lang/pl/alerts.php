<?php

return [

    'success' => [
    ],
    'error' => [
        'invalid_role' => 'Nie posiadasz odpowiedniej roli systemowej do wykonania tej akcji.',
        'no_permission' => 'Nie posiadasz odpowiednich uprawnień do wykonania tej akcji.',
    ],
    'warning' => [

    ],
    'info' => [

    ],

    'settings' => [

        'success' => [
            // SETTINGS
            'cache_clear' => 'Pamięć podręczna aplikacji została pomyślnie wyczyszczona!',
            'mail_update' => 'Dane serwera SMTP zostały zaktualizowane. Cache został automatycznie wyczyszczony.',
            'general'     => 'Ustawienia platformy zostały zaktualizowane.',
        ],
        'error' => [
            //SETTINGS
            'cache_clear' => 'Podczas czyszczenia pamięci podręcznej aplikacji serwer napotkał problemy. Sprawdź uprawnienia serwera.',
            'mail_update' => 'Dane serwera SMTP nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            'general'     => 'Ustawienia platformy nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
        ],
        'warning' => [

        ],
        'info' => [

        ],

    ],

    'campaigns' => [
        'success' => [
            'create' => 'Kampania została utworzona pomyślnie.',
            'objective_added' => 'Wskazany cel został pomyślnie dodany do Kampanii.',
            'users_added' => 'Uzupełniono stan osobowy Kampanii pomiarowej.',
        ],

        'error' => [
            'create' => 'Kampanie nie mogła zostać dodana. Wystąpił błąd.',
        ],

    ],

    'users' => [
        'success' => [
            'create' => 'Nowy użytkownik został pomyślnie dodany do systemu.',
            'edit' => 'Użytkownik :name został pomyślnie zmodyfikowany.',
            'blocked' => 'Użytkownik :name został zablokowany. Nie posiada już dostępu do systemu.',
            'unblocked' => 'Użytkownik :name został odblokowany. Może spowrotem logować się do systemu.',
            'delete' => 'Użytkownik :name został usunięty z systemu.',
        ],

        'error' => [
            'create' => 'Wystąpił błąd, użytkownik nie mógł być dodany.',
            'edit' => 'Użytkownik nie mógł zostać zmodyfikowany. Podczas operacji wystąpił nieoczekiwany błąd.',
            'delete' => 'Użytkownik :name nie mógł zostać usunięty z systemu. Podczas operacji wystąpił nieoczekiwany błąd.',
        ],

        'warning' => [
            'user_is_root' => 'Uwaga, ten użytkownik posiada uprawnienia Roota.',
        ],

        'info' => [
            'block' => 'Wskutek tej akcji użytkownik utraci dostęp do systemu, a jego przełożeni mogą mieć odebrane niektóre prawa.',
            'delete' => 'Usunięcie użytkownika będzie nieodwracalne.',
        ],
    ],

    'objective_template' => [
        'success' => [
            'create' => 'Nowy szablon celu został pomyślnie dodany.',
            'edit' => 'Szablon celu został pomyślnie zmodyfikowany.',
            'delete' => 'Szablon celu został pomyślnie usunięty.',
        ],
    ],

    'datatables' => [
        'save_columns' => [
            'error_data' => 'Nie wykryto nowych danych dotyczących wyświetlania kolumn w tabeli. Zmiany nie zostały zapisane.',
            'error' => 'Nie można było zapisać nowych danych dotyczących kolumn w tabeli. Wystąpił błąd.',
        ]
    ]

];
