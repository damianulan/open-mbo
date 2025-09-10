<?php

return [

    'system' => [
        'unauthorized_module' => 'Moduł, który próbujesz otworzyć został zablokowany przez administratora systemu.',
    ],
    'success' => [
        'operation' => 'Operacja zakończona pomyślnie.',
    ],
    'error' => [
        'invalid_role' => 'Nie posiadasz odpowiedniej roli systemowej do wykonania tej akcji.',
        'no_permission' => 'Nie posiadasz odpowiednich uprawnień do wykonania tej akcji.',
        'ajax' => 'Wystąpił błąd podczas pobierania danych z serwera, żądanie nie zostało przetworzone. Zweryfikuj swoje połączenie internetowe.',
        'operation' => 'Wystąpił błąd podczas wykonywania operacji.',
        'form' => 'W formularzu wystąpiły błędy. Popraw je i spróbuj ponownie.',
    ],
    'warning' => [
        'operation' => 'Uwaga!',
    ],
    'info' => [
        'maintenance' => 'Serwis jest zamknięty dla użytkowników.',
        'env_local' => 'Aplikacja działa w trybie lokalnym',
        'env_development' => 'Aplikacja uruchomiona w trybie deweloperskim. Część funkcjonalności może nie działać zgodnie z oczekiwaniami',
        'debugging' => 'Uwaga - Debugowanie jest włączone',
    ],

    'settings' => [

        'success' => [
            // SETTINGS
            'cache_clear' => 'Pamięć podręczna aplikacji została pomyślnie wyczyszczona!',
            'mail_update' => 'Dane serwera SMTP zostały zaktualizowane. Cache został automatycznie wyczyszczony.',
            'mbo_update' => 'Ustawienia modułu MBO zostały zaktualizowane.',
            'general' => 'Ustawienia platformy zostały zaktualizowane.',
        ],
        'error' => [
            // SETTINGS
            'cache_clear' => 'Podczas czyszczenia pamięci podręcznej aplikacji serwer napotkał problemy. Sprawdź uprawnienia serwera.',
            'mail_update' => 'Dane serwera SMTP nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            'mbo_update' => 'Ustawienia modułu MBO nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            'general' => 'Ustawienia platformy nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
        ],
        'warning' => [],
        'info' => [],

    ],

    'campaigns' => [
        'success' => [
            'create' => 'Kampania została utworzona pomyślnie.',
            'edit' => 'Kampania została pomyślnie zmodyfikowana.',
            'objective_added' => 'Wskazany cel został pomyślnie dodany do Kampanii.',
            'objective_deleted' => 'Cel został pomyślnie usunięty z Kampanii.',
            'users_added' => 'Uzupełniono stan osobowy Kampanii pomiarowej.',
            'users_deleted' => 'Użytkownik został wypisany z Kampanii.',
            "terminate" => "Kampania została pomyślnie zawieszona.",
            "resume" => "Kampania została pomyślnie odwieszona.",
            'cancel' => 'Kampania została pomyślnie anulowana.',

        ],

        'error' => [
            'create' => 'Kampanie nie mogła zostać dodana. Wystąpił błąd.',
            'edit' => 'Kampania nie została zmodyfikowana. W formularzu wystąpiły błędy.',
            'objective_added' => 'Wskazany cel został pomyślnie dodany do Kampanii.',
            'objective_deleted' => 'Cel został pomyślnie usunięty z Kampanii.',
            'users_added' => 'Dane nie zostały zaktualizowane. Odśwież stronę i spróbuj ponownie.',
            'users_deleted' => 'Wystąpił błąd podczas wypisywania użytkownika z Kampanii. Odśwież stronę i spróbuj ponownie.',
            "terminate" => "Kampania nie została pomyślnie zawieszona.",
            "resume" => "Kampania nie została pomyślnie odwieszona.",
            'cancel' => 'Kampania nie została pomyślnie anulowana.',
        ],

        'info' => [],

    ],

    'objectives' => [
        'success' => [
            'users_added' => 'Uzupełniono przypisanie użytkowników do celu.',
            'realization_updated' => 'Dane o realizacji celu zostały zaktualizowane.',
        ],

        'error' => [
            'overdued' => 'Termin realizacji tego celu minął :term',
            'users_added' => 'Dane nie zostały zaktualizowane. Odśwież stronę i spróbuj ponownie.',
            'realization_updated' => 'Dane o realizacji celu nie mogły zostać zaktualizowane. Wystąpił nieoczekiwany błąd.',
        ],

        'info' => [
            'delete' => 'Usunięcie celu będzie nieodwracalne.',
        ],
    ],

    'user_objectives' => [
        'success' => [
            'set_passed' => 'Cel został oznaczony jako zaliczony.',
            'set_failed' => 'Cel został oznaczony jako niezaliczony.',
        ],
        'error' => [
            'set_passed' => 'Nie można oznaczyć celu jako zaliczony.',
            'set_failed' => 'Nie można oznaczyć celu jako niezaliczony.',
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

        'error' => [
            'create' => 'Nowy szablon celu nie mógł zostać dodany. Wystąpił błąd.',
            'edit' => 'Szablon celu nie został zmodyfikowany. Wystąpił błąd.',
            'delete' => 'Szablon celu niestety nie został usunięty. Wystąpił błąd.',
        ],
    ],

    'objective_categories' => [
        'success' => [
            'create' => 'Nowa kategoria MBO została pomyślnie dodana.',
            'edit' => 'Kategoria MBO została pomyślnie zmodyfikowana.',
            'delete' => 'Kategoria MBO została pomyślnie usunięta.',
        ],

        'error' => [
            'create' => 'Nowa kategoria MBO nie mógła zostać dodana. Wystąpił błąd.',
            'edit' => 'Kategoria MBO nie została zmodyfikowana. Wystąpił błąd.',
            'delete' => 'Kategoria MBO niestety nie została usunięta. Wystąpił błąd.',
        ],

        'info' => [
            'delete' => 'Usunięcie kategorii będzie nieodwracalne. Razem z nią usunięte zostaną wszystkie powiązane cele.',
        ],
    ],

    'datatables' => [
        'save_columns' => [
            'error_data' => 'Nie wykryto nowych danych dotyczących wyświetlania kolumn w tabeli. Zmiany nie zostały zapisane.',
            'error' => 'Nie można było zapisać nowych danych dotyczących kolumn w tabeli. Wystąpił błąd.',
        ],
    ],

];
