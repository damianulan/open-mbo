<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Auth extends Seeder
{
    public static function list(): array
    {
        return array(
            'failed' => array(
                'pl' => 'Nie możemy odnaleźć użytkownika z takimi danymi',
            ),
            'password' => array(
                'pl' => 'Podane hasło jest nieprawidłowe.',
            ),
            'throttle' => array(
                'pl' => 'Zbyt wiele prób logowania. Spróbuj ponownie za :seconds sekund.',
            ),
            'login_info' => array(
                'pl' => '<strong>UWAGA</strong> - serwis jest na etapie produkcji. Nie wszystkie funkcjonalności są sprawne.<br/>Zaloguj się z użyciem globalnych danych zawartych poniżej.',
            ),
            'maintenance_info' => array(
                'pl' => '<strong>UWAGA</strong> - obecnie serwis jest zamknięty na potrzeby prac konserwacyjnych.<br/>Dostęp do serwisu jest ograniczony, spróbuj ponownie później.',
            ),
        );
    }
}
