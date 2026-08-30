<?php

return [
    'errors' => [
        '401' => [
            'paragraph' => '',
            'title' => 'Dostęp nieautoryzowany',
        ],
        '403' => [
            'paragraph' => 'Nie posiadasz wystarczających uprawnień niezbędnych do wyświetlania tej strony. Jeśli to błąd, skontaktuj się z administratorem systemu.',
            'title' => 'Odmowa dostępu',
        ],
        '404' => [
            'paragraph' => 'Nie udało się odnaleźć żądanej strony.',
            'title' => 'Nie znaleziono strony, lub jest ona tymczasowo niedostępna',
        ],
        '419' => [
            'paragraph' => 'Twój sekretny klucz jest nieprawidłowy, bądź wygasła twoja sesja. Zaloguj się jeszcze raz i spróbuj ponownie.',
            'title' => 'Sesja wygasła',
        ],
        '500' => [
            'paragraph' => 'Serwer nie był w stanie przetworzyć żądania. Zarejestrowaliśmy ten incydent i przeanalizujemy źródło błędu. Dziękujemy.',
            'title' => 'Wewnętrzny błąd serwera',
        ],
        '503' => [
            'paragraph' => 'Przepraszamy, usługa chwilowo niedostępna. Trwają prace konserwacyjne, spróbuj ponownie później. Zostaniesz automatycznie wylogowany.',
            'title' => 'Usługa niedostępna',
        ],
        'common' => 'To chyba nie strona, której szukasz...',
    ],
    'home' => [
        'my_campaigns' => 'Moje kampanie',
        'my_objectives' => 'Moje cele',
        'my_points' => 'Moje punkty',
    ],
    'settings' => [
        'branding' => 'Branding',
        'build' => 'Build',
        'cache_clear' => 'Wyczyść cache',
        'debugbar' => 'Pasek debugowania',
        'debugging' => 'Tryb debugowania',
        'environment' => 'Środowisko',
        'general' => 'Ogólne',
        'git_status' => 'Git status',
        'info' => 'Konfiguracja PHP',
        'modules' => 'Zarządzanie modułami platformy',
        'phpinfo' => 'PHP Info',
        'phpversion' => 'Wersja PHP',
        'release' => 'Wersja',
        'server_info' => 'Informacje o serwerze',
        'telescope' => 'Teleskop',
        'timezone' => 'Strefa czasowa',
        'app' => 'Ustawienia aplikacji',
        'smtp_server' => 'Serwer poczty wychodzącej (SMTP)',
    ],
];
