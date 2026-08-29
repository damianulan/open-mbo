<?php

return [
    'campaigns' => [
        'error' => [
            'cancel' => 'Kampania nie została pomyślnie anulowana.',
            'create' => 'Kampanie nie mogła zostać dodana. Wystąpił błąd.',
            'edit' => 'Kampania nie została zmodyfikowana. W formularzu wystąpiły błędy.',
            'objective_added' => 'Wskazany cel został pomyślnie dodany do Kampanii.',
            'objective_deleted' => 'Cel został pomyślnie usunięty z Kampanii.',
            'resume' => 'Kampania nie została pomyślnie odwieszona.',
            'terminate' => 'Kampania nie została pomyślnie zawieszona.',
            'users_added' => 'Dane nie zostały zaktualizowane. Odśwież stronę i spróbuj ponownie.',
            'users_deleted' => 'Wystąpił błąd podczas wypisywania użytkownika z Kampanii. Odśwież stronę i spróbuj ponownie.',
        ],
        'success' => [
            'cancel' => 'Kampania została pomyślnie anulowana.',
            'create' => 'Kampania została utworzona pomyślnie.',
            'edit' => 'Kampania została pomyślnie zmodyfikowana.',
            'objective_added' => 'Wskazany cel został pomyślnie dodany do Kampanii.',
            'objective_deleted' => 'Cel został pomyślnie usunięty z Kampanii.',
            'resume' => 'Kampania została pomyślnie odwieszona.',
            'terminate' => 'Kampania została pomyślnie zawieszona.',
            'users_added' => 'Uzupełniono stan osobowy Kampanii pomiarowej.',
            'users_deleted' => 'Użytkownik został wypisany z Kampanii.',
        ],
    ],
    'companies' => [
        'info' => [
            'delete' => 'Usunięcie przedsiębiorstwa będzie nieodwracalne.',
        ],
    ],
    'contracts' => [
        'info' => [
            'delete' => 'Usunięcie typu kontraktu będzie nieodwracalne.',
        ],
    ],
    'datatables' => [
        'save_columns' => [
            'error' => 'Nie można było zapisać nowych danych dotyczących kolumn w tabeli. Wystąpił błąd.',
            'error_data' => 'Nie wykryto nowych danych dotyczących wyświetlania kolumn w tabeli. Zmiany nie zostały zapisane.',
        ],
    ],
    'departments' => [
        'info' => [
            'delete' => 'Usunięcie działu będzie nieodwracalne.',
        ],
    ],
    'employments' => [
        'error' => [
            'create' => 'Nowe zatrudnienie nie mógło zostać dodane. Wystąpił błąd.',
            'delete' => 'Zatrudnienie nie mógło zostać usunięte. Wystąpił błąd.',
            'edit' => 'Zatrudnienie nie mógło zostać zmodyfikowane. Wystąpił błąd.',
        ],
        'success' => [
            'create' => 'Nowe zatrudnienie zostało pomyślnie dodane.',
            'delete' => 'Zatrudnienie zostało pomyślnie usunięte.',
            'edit' => 'Zatrudnienie zostało pomyślnie zmodyfikowane.',
        ],
    ],
    'success' => [
        'operation' => 'Operacja zakończona pomyślnie.',
    ],
    'error' => [
        'ajax' => 'Wystąpił błąd podczas pobierania danych z serwera, żądanie nie zostało przetworzone. Zweryfikuj swoje połączenie internetowe.',
        'form' => 'W formularzu wystąpiły błędy. Popraw je i spróbuj ponownie.',
        'invalid_role' => 'Nie posiadasz odpowiedniej roli systemowej do wykonania tej akcji.',
        'no_permission' => 'Nie posiadasz odpowiednich uprawnień do wykonania tej akcji.',
        'operation' => 'Wystąpił błąd podczas wykonywania operacji.',
        'unauthorized_access' => 'Nie masz uprawnień do wykonania tej akcji.',
    ],
    'info' => [
        'debugging' => 'Uwaga - Debugowanie jest włączone',
        'env_development' => 'Aplikacja uruchomiona w trybie deweloperskim. Część funkcjonalności może nie działać zgodnie z oczekiwaniami',
        'env_local' => 'Aplikacja działa w trybie lokalnym',
        'maintenance' => 'Serwis jest zamknięty dla użytkowników.',
    ],
    'objective_categories' => [
        'error' => [
            'create' => 'Nowa kategoria MBO nie mógła zostać dodana. Wystąpił błąd.',
            'delete' => 'Kategoria MBO niestety nie została usunięta. Wystąpił błąd.',
            'edit' => 'Kategoria MBO nie została zmodyfikowana. Wystąpił błąd.',
        ],
        'info' => [
            'delete' => 'Usunięcie kategorii będzie nieodwracalne. Razem z nią usunięte zostaną wszystkie powiązane cele.',
        ],
        'success' => [
            'create' => 'Nowa kategoria MBO została pomyślnie dodana.',
            'delete' => 'Kategoria MBO została pomyślnie usunięta.',
            'edit' => 'Kategoria MBO została pomyślnie zmodyfikowana.',
        ],
    ],
    'positions' => [
        'info' => [
            'delete' => 'Usunięcie stanowiska będzie nieodwracalne.',
        ],
    ],
    'notifications' => [
        'info' => [
            'delete' => 'Usunięcie powiadomienia będzie nieodwracalne.',
        ],
    ],
    'objective_template' => [
        'error' => [
            'create' => 'Nowy szablon celu nie mógł zostać dodany. Wystąpił błąd.',
            'delete' => 'Szablon celu niestety nie został usunięty. Wystąpił błąd.',
            'edit' => 'Szablon celu nie został zmodyfikowany. Wystąpił błąd.',
        ],
        'success' => [
            'create' => 'Nowy szablon celu został pomyślnie dodany.',
            'delete' => 'Szablon celu został pomyślnie usunięty.',
            'edit' => 'Szablon celu został pomyślnie zmodyfikowany.',
        ],
    ],
    'objectives' => [
        'error' => [
            'overdued' => 'Termin realizacji tego celu minął :term',
            'realization_updated' => 'Dane o realizacji celu nie mogły zostać zaktualizowane. Wystąpił nieoczekiwany błąd.',
            'users_added' => 'Dane nie zostały zaktualizowane. Odśwież stronę i spróbuj ponownie.',
        ],
        'info' => [
            'delete' => 'Usunięcie celu będzie nieodwracalne.',
        ],
        'success' => [
            'realization_updated' => 'Dane o realizacji celu zostały zaktualizowane.',
            'users_added' => 'Uzupełniono przypisanie użytkowników do celu.',
        ],
    ],
    'settings' => [
        'error' => [
            'cache_clear' => 'Podczas czyszczenia pamięci podręcznej aplikacji serwer napotkał problemy. Sprawdź uprawnienia serwera.',
            'general' => 'Ustawienia platformy nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            'mail_update' => 'Dane serwera SMTP nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            'update' => 'Ustawienia modułu nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
        ],
        'success' => [
            'cache_clear' => 'Pamięć podręczna aplikacji została pomyślnie wyczyszczona!',
            'general' => 'Ustawienia platformy zostały zaktualizowane.',
            'mail_update' => 'Dane serwera SMTP zostały zaktualizowane. Cache został automatycznie wyczyszczony.',
            'update' => 'Ustawienia modułu zostały zaktualizowane.',
        ],
    ],
    'system' => [
        'unauthorized_module' => 'Moduł, który próbujesz otworzyć został zablokowany przez administratora systemu.',
    ],
    'user_objectives' => [
        'error' => [
            'set_failed' => 'Nie można oznaczyć celu jako niezaliczony.',
            'set_passed' => 'Nie można oznaczyć celu jako zaliczony.',
        ],
        'success' => [
            'set_failed' => 'Cel został oznaczony jako niezaliczony.',
            'set_passed' => 'Cel został oznaczony jako zaliczony.',
        ],
    ],
    'users' => [
        'error' => [
            'create' => 'Wystąpił błąd, użytkownik nie mógł być dodany.',
            'delete' => 'Użytkownik :name nie mógł zostać usunięty z systemu. Podczas operacji wystąpił nieoczekiwany błąd.',
            'edit' => 'Użytkownik nie mógł zostać zmodyfikowany. Podczas operacji wystąpił nieoczekiwany błąd.',
        ],
        'info' => [
            'block' => 'Wskutek tej akcji użytkownik utraci dostęp do systemu, a jego przełożeni mogą mieć odebrane niektóre prawa.',
            'delete' => 'Usunięcie użytkownika będzie nieodwracalne.',
        ],
        'success' => [
            'blocked' => 'Użytkownik :name został zablokowany. Nie posiada już dostępu do systemu.',
            'create' => 'Nowy użytkownik został pomyślnie dodany do systemu.',
            'delete' => 'Użytkownik :name został usunięty z systemu.',
            'edit' => 'Użytkownik :name został pomyślnie zmodyfikowany.',
            'unblocked' => 'Użytkownik :name został odblokowany. Może spowrotem logować się do systemu.',
        ],
        'warning' => [
            'user_is_root' => 'Uwaga, ten użytkownik posiada uprawnienia Roota.',
        ],
    ],
    'warning' => [
        'operation' => 'Uwaga!',
    ],
    'teams' => [
        'info' => [
            'delete' => 'Usunięcie zespołu będzie nieodwracalne.',
        ],
    ],
];
