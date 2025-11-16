<?php

/**
 * Declare comments for logger.
 * Pass lang path as a parameter while logging something.
 * Keep model logs in 'log' and activity logs in 'activity'.
 */
return array(

    'columns' => array(
        'causer' => 'Inicjator',
        'subject' => 'Odnosi się do',
        'subject_type' => 'Odnosi się do typu',
        'created_at' => 'Kiedy',
        'event' => 'Zdarzenie',
        'description' => 'Opis',

    ),

    'events' => array(
        'viewed' => 'Wyświetlono',
        'created' => 'Utworzenie obiektu',
        'updated' => 'Aktualizacja danych',
        'logged_out' => 'Wylogowanie',
        'auth_attempt_success' => 'Pomyślnie logowanie',
        'auth_attempt_fail' => 'Niepowodzenie logowania',
        'deleted' => 'Usunięcie obiektu',
    ),

    'log_name' => array(
        'system' => 'System',
        'auth' => 'Identyfikacja użytkownika',
        'model' => 'Zmiana danych',
    ),

    'description' => array(
        'created' => 'Użytkownik :username utworzył nową instancję obiektu: :model_map.',
        'updated' => 'Użytkownik :username zmodyfikował instancję obiektu: :model_map.',
        'deleted' => 'Użytkownik :username usunął instancję obiektu: :model_map.',
        'auth_attempt_success' => 'Zarejestrowano pomyślną próbę logowania użytkownika.',
        'auth_attempt_fail' => 'Zarejestrowano pomyślną próbę logowania użytkownika.',
        'auth_logout' => 'Użytkownik wylogował się z systemu.',
        'notification_sent' => 'Użytkownik :username otrzymał powiadomienie: :type',
        'view' => 'Użytkownik :username wyświetlił obiekt: :model_map',
    ),

    'model_mapping' => array(
        'App\Models\MBO\ObjectiveTemplate' => 'Szablon celu',
        'App\Models\MBO\Objective' => 'Cel',
        'App\Models\MBO\Campaign' => 'Kampania pomiarowa',
        'App\Models\MBO\ObjectiveTemplateCategory' => 'Kategoria MBO',
        'App\Models\MBO\UserCampaign' => 'Modyfikacja przypisania użytkownika do kampanii',
        'App\Models\MBO\UserObjective' => 'Modyfikacja przypisania użytkownika do celu',
    ),

    'route_mapping' => array(
        'App\Models\MBO\ObjectiveTemplate' => 'templates.edit',
        'App\Models\MBO\Objective' => 'objectives.show',
        'App\Models\MBO\Campaign' => 'campaigns.show',
        'App\Models\MBO\UserObjective' => 'campaigns.users.update',
        'App\Models\MBO\UserCampaign' => 'campaigns.users.update',
        'App\Models\MBO\ObjectiveTemplateCategory' => 'management.mbo.categories.edit',
    ),

);
