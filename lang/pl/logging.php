<?php

/**
 * Declare comments for logger.
 * Pass lang path as a parameter while logging something.
 * Keep model logs in 'log' and activity logs in 'activity'.
 */
return [

    'columns' => [
        'causer' => 'Inicjator',
        'subject' => 'Odnosi się do',
        'subject_type' => 'Odnosi się do typu',
        'created_at' => 'Kiedy',
        'event' => 'Zdarzenie',
        'description' => 'Opis',

    ],

    'events' => [
        'created' => 'Utworzenie obiektu',
        'updated' => 'Aktualizacja danych',
        'logged_out' => 'Wylogowanie',
        'auth_attempt_success' => 'Pomyślnie logowanie',
        'auth_attempt_fail' => 'Niepowodzenie logowania',
        'deleted' => 'Usunięcie obiektu',
    ],

    'log_name' => [
        'system' => 'System',
        'auth' => 'Identyfikacja użytkownika',
        'model' => 'Zmiana danych',
    ],

    'description' => [
        'created' => 'Użytkownik :username utworzył nową instancję obiektu: :model_map.',
        'updated' => 'Użytkownik :username zmodyfikował instancję obiektu: :model_map.',
        'deleted' => 'Użytkownik :username usunął instancję obiektu: :model_map.',
        'auth_attempt_success' => 'Zarejestrowano pomyślną próbę logowania użytkownika.',
        'auth_attempt_fail' => 'Zarejestrowano pomyślną próbę logowania użytkownika.',
        'auth_logout' => 'Użytkownik wylogował się z systemu.',
    ],

    'model_mapping' => [
        'App\Models\MBO\ObjectiveTemplate' => 'Szablon celu',
        'App\Models\MBO\Objective' => 'Cel',
        'App\Models\MBO\Campaign' => 'Kampania pomiarowa',

    ],

    'route_mapping' => [
        'App\Models\MBO\ObjectiveTemplate' => 'management.objectives.edit',
        'App\Models\MBO\Objective' => 'objectives.show',
        'App\Models\MBO\Campaign' => 'campaigns.show',
        'App\Models\MBO\UserObjective' => 'campaigns.users.update',
        'App\Models\MBO\UserCampaign' => 'campaigns.users.update',
    ],

];
