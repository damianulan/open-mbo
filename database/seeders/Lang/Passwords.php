<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Passwords extends Seeder
{
    public static function list(): array
    {
        return array(
            'reset' => array(
                'pl' => 'Twoje hasło zostało zresetowane!',
            ),
            'sent' => array(
                'pl' => 'Na twój adres e-mail została wysłana wiadomość z linkiem umożliwiającym zresetowanie hasła.',
            ),
            'throttled' => array(
                'pl' => 'Poczekaj chwilę zanim spróbujesz ponownie.',
            ),
            'token' => array(
                'pl' => 'Token odebrany przez serwer nie jest ważny.',
            ),
            'user' => array(
                'pl' => 'Nie możemy znaleźć użytkownika z takim adresem e-mail.',
            ),
        );
    }
}
