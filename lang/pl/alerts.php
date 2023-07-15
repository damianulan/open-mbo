<?php

return [

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

    'courses' => [
        'success' => [
            'create' => 'Pomyślnie udało się dodać nowy kurs o nazwie :coursetitle.',
            'update' => 'Kurs o nazwie :coursetitle został pomyślnie zaktualizowany.',
            'hide' => 'Widoczność kursu :coursetitle została nadpisana.',
            'delete' => 'Kurs :coursetitle został pomyślnie usunięty.',
        ],
        'error' => [
            'create' => 'Wystąpił błąd. Nie udało się dodać kursu :coursetitle.',
            'update' => 'Wystąpił błąd. Nie udało się zaktualizować kursu :coursetitle.',
            'hide' => 'Widoczność kursu :coursetitle nie mogła zostać nadpisana. Wystąpił błąd.',
            'delete' => 'Kurs :coursetitle nie mógł zostać usunięty. Wystąpił błąd.',
        ],
        'warning' => [

        ],
        'info' => [

        ],
    ],

];
