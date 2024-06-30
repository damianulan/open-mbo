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
        ],

        'error' => [
            'create' => 'Kampanie nie mogła zostać dodana. Wystąpił błąd.',
        ],

    ],

    'users' => [
        'success' => [
            'create' => 'Nowy użytkownik został pomyślnie dodany do systemu.',
            'edit' => 'Użytkownik :name został pomyślnie zmodyfikowany.',
        ],

        'error' => [
            'create' => 'Wystąpił błąd, użytkownik nie mógł być dodany.',
            'edit' => 'Użytkownik nie mógł zostać zmodyfikowany. Podczas operacji wystąpił nieoczekiwany błąd.',
        ],

        'warning' => [
            'user_is_root' => 'Uwaga, ten użytkownik posiada uprawnienia Roota.',
        ]
    ],

    'objective_template' => [
        'success' => [
            'create' => 'Nowy szablon celu został pomyślnie dodany.',
            'edit' => 'Szablon celu został pomyślnie zmodyfikowany.',
            'delete' => 'Szablon celu został pomyślnie usunięty.',
        ],
    ],

];
