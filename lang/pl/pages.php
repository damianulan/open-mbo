<?php

return [
    'settings' => [
        'server_info' => 'Informacje o serwerze',
        'git_status' => 'Git status',
        'debugging' => 'Tryb debugowania',
        'environment' => 'Środowisko',
        'build' => 'Build',
        'release' => 'Wersja',
        'cache_clear' => 'Wyczyść cache',
        'timezone' => 'Strefa czasowa',
        'general' => 'Ogólne',
        'branding' => 'Branding',
        'modules' => 'Zarządzanie modułami platformy',
        'phpversion' => 'Wersja PHP',
        'info' => 'Konfiguracja PHP',
        'phpinfo' => 'PHP Info',
        'telescope' => 'Teleskop',
    ],


    'errors' => [
        '500' => [
            'title' => 'Wewnętrzny błąd serwera',
            'paragraph' => 'Serwer nie był w stanie przetworzyć żądania. Zarejestrowaliśmy ten incydent i przeanalizujemy źródło błędu. Dziękujemy.',
        ],
        '503' => [
            'title' => 'Usługa niedostępna',
            'paragraph' => 'Przepraszamy, usługa chwilowo niedostępna. Trwają prace konserwacyjne, spróbuj ponownie później. Zostaniesz automatycznie wylogowany.',
        ],
        '404' => [
            'title' => 'Nie znaleziono strony',
            'paragraph' => 'Nie udało się odnaleźć żądanej strony.',
        ],
        '403' => [
            'title' => 'Brak uprawnień',
            'paragraph' => 'Nie posiadasz wystarczających uprawnień niezbędnych do wyświetlania tej strony. Jeśli to błąd, skontaktuj się z administratorem systemu.',
        ],
        '401' => [
            'title' => 'Dostęp nieautoryzowany',
            'paragraph' => '',
        ],
        '419' => [
            'title' => 'Sesja wygasła',
            'paragraph' => 'Twój sekretny klucz jest nieprawidłowy, bądź wygasła twoja sesja. Zaloguj się jeszcze raz i spróbuj ponownie.',
        ],
        'common' => 'To chyba nie strona, której szukasz...',

    ],
];
