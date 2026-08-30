<?php

return [
    'columns' => [
        'causer' => 'Inicjator',
        'created_at' => 'Kiedy',
        'description' => 'Opis',
        'event' => 'Zdarzenie',
        'subject' => 'Odnosi się do',
        'subject_type' => 'Odnosi się do typu',
    ],
    'description' => [
        'auth_attempt_fail' => 'Zarejestrowano próbę logowania użytkownika zakończoną niepowodzeniem.',
        'auth_attempt_success' => 'Zarejestrowano pomyślną próbę logowania użytkownika.',
        'auth_logout' => 'Użytkownik wylogował się z systemu.',
        'created' => 'Użytkownik :username utworzył nową instancję obiektu: :model_map.',
        'deleted' => 'Użytkownik :username usunął instancję obiektu: :model_map.',
        'notification_sent' => 'Użytkownik :username otrzymał powiadomienie: :type',
        'updated' => 'Użytkownik :username zmodyfikował instancję obiektu: :model_map.',
        'view' => 'Użytkownik :username wyświetlił obiekt: :model_map',
    ],
    'events' => [
        'auth_attempt_fail' => 'Niepowodzenie logowania',
        'auth_attempt_success' => 'Pomyślnie logowanie',
        'created' => 'Utworzenie obiektu',
        'deleted' => 'Usunięcie obiektu',
        'logged_out' => 'Wylogowanie',
        'updated' => 'Aktualizacja danych',
        'viewed' => 'Wyświetlono',
    ],
    'log_name' => [
        'auth' => 'Identyfikacja użytkownika',
        'model' => 'Zmiana danych',
        'system' => 'System',
    ],
    'model_mapping' => [
        'App\\Models\\MBO\\Campaign' => 'Kampania pomiarowa',
        'App\\Models\\MBO\\Objective' => 'Cel',
        'App\\Models\\MBO\\ObjectiveTemplate' => 'Szablon celu',
        'App\\Models\\MBO\\ObjectiveTemplateCategory' => 'Kategoria MBO',
        'App\\Models\\MBO\\UserCampaign' => 'Modyfikacja przypisania użytkownika do kampanii',
        'App\\Models\\MBO\\UserObjective' => 'Modyfikacja przypisania użytkownika do celu',
    ],
    'route_mapping' => [
        'App\\Models\\MBO\\Campaign' => 'campaigns.show',
        'App\\Models\\MBO\\Objective' => 'objectives.show',
        'App\\Models\\MBO\\ObjectiveTemplate' => 'templates.edit',
        'App\\Models\\MBO\\ObjectiveTemplateCategory' => 'management.mbo.categories.edit',
        'App\\Models\\MBO\\UserCampaign' => 'campaigns.users.update',
        'App\\Models\\MBO\\UserObjective' => 'campaigns.users.update',
    ],
];
