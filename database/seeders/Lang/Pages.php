<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Pages extends Seeder
{
    public static function list(): array
    {
        return [
            'settings.server_info' => [
                'pl' => 'Informacje o serwerze',
                'en' => 'Server info',
            ],
            'settings.git_status' => [
                'pl' => 'Git status',
                'en' => 'Git status',
            ],
            'settings.debugging' => [
                'pl' => 'Tryb debugowania',
                'en' => 'Debug mode',
            ],
            'settings.debugbar' => [
                'pl' => 'Pasek debugowania',
                'en' => 'DebugBar',
            ],
            'settings.environment' => [
                'pl' => 'Środowisko',
                'en' => 'Environment',
            ],
            'settings.build' => [
                'pl' => 'Build',
                'en' => 'Build',
            ],
            'settings.release' => [
                'pl' => 'Wersja',
                'en' => 'Release',
            ],
            'settings.cache_clear' => [
                'pl' => 'Wyczyść cache',
                'en' => 'Clear cache',
            ],
            'settings.timezone' => [
                'pl' => 'Strefa czasowa',
                'en' => 'Timezone',
            ],
            'settings.general' => [
                'pl' => 'Ogólne',
                'en' => 'General',
            ],
            'settings.branding' => [
                'pl' => 'Branding',
                'en' => 'Branding',
            ],
            'settings.modules' => [
                'pl' => 'Zarządzanie modułami platformy',
                'en' => 'Manage platform modules',
            ],
            'settings.phpversion' => [
                'pl' => 'Wersja PHP',
                'en' => 'PHP version',
            ],
            'settings.info' => [
                'pl' => 'Konfiguracja PHP',
                'en' => 'PHP info',
            ],
            'settings.phpinfo' => [
                'pl' => 'PHP Info',
                'en' => 'PHP info',
            ],
            'settings.telescope' => [
                'pl' => 'Teleskop',
                'en' => 'Telescope',
            ],
            'home.my_objectives' => [
                'pl' => 'Moje cele',
                'en' => 'My objectives',
            ],
            'home.my_campaigns' => [
                'pl' => 'Moje kampanie',
                'en' => 'My campaigns',
            ],
            'errors.500.title' => [
                'pl' => 'Wewnętrzny błąd serwera',
                'en' => 'Internal server error',
            ],
            'errors.500.paragraph' => [
                'pl' => 'Serwer nie był w stanie przetworzyć żądania. Zarejestrowaliśmy ten incydent i przeanalizujemy źródło błędu. Dziękujemy.',
                'en' => 'The server was unable to process the request. We have registered this incident and are analyzing the source of the error. Thank you.',
            ],
            'errors.503.title' => [
                'pl' => 'Usługa niedostępna',
                'en' => 'Service unavailable',
            ],
            'errors.503.paragraph' => [
                'pl' => 'Przepraszamy, usługa chwilowo niedostępna. Trwają prace konserwacyjne, spróbuj ponownie później. Zostaniesz automatycznie wylogowany.',
                'en' => 'Sorry, the service is temporarily unavailable. There are ongoing consultancy work, please try again later. You will be automatically logged out.',
            ],
            'errors.404.title' => [
                'pl' => 'Nie znaleziono strony, lub jest ona tymczasowo niedostępna',
                'en' => 'Page not found, or it is temporarily unavailable',
            ],
            'errors.404.paragraph' => [
                'pl' => 'Nie udało się odnaleźć żądanej strony.',
                'en' => 'The page you are looking for could not be found.',
            ],
            'errors.403.title' => [
                'pl' => 'Odmowa dostępu',
                'en' => 'Access denied',
            ],
            'errors.403.paragraph' => [
                'pl' => 'Nie posiadasz wystarczających uprawnień niezbędnych do wyświetlania tej strony. Jeśli to błąd, skontaktuj się z administratorem systemu.',
                'en' => 'You do not have the necessary permissions to display this page. If this is an error, please contact the system administrator.',
            ],
            'errors.401.title' => [
                'pl' => 'Dostęp nieautoryzowany',
                'en' => 'Unauthorized access',
            ],
            'errors.401.paragraph' => [
                'pl' => '',
            ],
            'errors.419.title' => [
                'pl' => 'Sesja wygasła',
                'en' => 'Session expired',
            ],
            'errors.419.paragraph' => [
                'pl' => 'Twój sekretny klucz jest nieprawidłowy, bądź wygasła twoja sesja. Zaloguj się jeszcze raz i spróbuj ponownie.',
                'en' => 'Your secret key is invalid or your session has expired. Please log in again and try again.',
            ],
            'errors.common' => [
                'pl' => 'To chyba nie strona, której szukasz...',
                'en' => 'This is not the page you are looking for...',
            ],
        ];
    }
}
