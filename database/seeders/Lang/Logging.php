<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Logging extends Seeder
{
    public static function list(): array
    {
        return [
            'columns.causer' => [
                'pl' => 'Inicjator',
            ],
            'columns.subject' => [
                'pl' => 'Odnosi się do',
            ],
            'columns.subject_type' => [
                'pl' => 'Odnosi się do typu',
            ],
            'columns.created_at' => [
                'pl' => 'Kiedy',
            ],
            'columns.event' => [
                'pl' => 'Zdarzenie',
            ],
            'columns.description' => [
                'pl' => 'Opis',
            ],
            'events.viewed' => [
                'pl' => 'Wyświetlono',
            ],
            'events.created' => [
                'pl' => 'Utworzenie obiektu',
            ],
            'events.updated' => [
                'pl' => 'Aktualizacja danych',
            ],
            'events.logged_out' => [
                'pl' => 'Wylogowanie',
            ],
            'events.auth_attempt_success' => [
                'pl' => 'Pomyślnie logowanie',
            ],
            'events.auth_attempt_fail' => [
                'pl' => 'Niepowodzenie logowania',
            ],
            'events.deleted' => [
                'pl' => 'Usunięcie obiektu',
            ],
            'log_name.system' => [
                'pl' => 'System',
            ],
            'log_name.auth' => [
                'pl' => 'Identyfikacja użytkownika',
            ],
            'log_name.model' => [
                'pl' => 'Zmiana danych',
            ],
            'description.created' => [
                'pl' => 'Użytkownik :username utworzył nową instancję obiektu: :model_map.',
            ],
            'description.updated' => [
                'pl' => 'Użytkownik :username zmodyfikował instancję obiektu: :model_map.',
            ],
            'description.deleted' => [
                'pl' => 'Użytkownik :username usunął instancję obiektu: :model_map.',
            ],
            'description.auth_attempt_success' => [
                'pl' => 'Zarejestrowano pomyślną próbę logowania użytkownika.',
            ],
            'description.auth_attempt_fail' => [
                'pl' => 'Zarejestrowano próbę logowania użytkownika zakończoną niepowodzeniem.',
            ],
            'description.auth_logout' => [
                'pl' => 'Użytkownik wylogował się z systemu.',
            ],
            'description.notification_sent' => [
                'pl' => 'Użytkownik :username otrzymał powiadomienie: :type',
            ],
            'description.view' => [
                'pl' => 'Użytkownik :username wyświetlił obiekt: :model_map',
            ],
            'model_mapping.App\Models\MBO\ObjectiveTemplate' => [
                'pl' => 'Szablon celu',
            ],
            'model_mapping.App\Models\MBO\Objective' => [
                'pl' => 'Cel',
            ],
            'model_mapping.App\Models\MBO\Campaign' => [
                'pl' => 'Kampania pomiarowa',
            ],
            'model_mapping.App\Models\MBO\ObjectiveTemplateCategory' => [
                'pl' => 'Kategoria MBO',
            ],
            'model_mapping.App\Models\MBO\UserCampaign' => [
                'pl' => 'Modyfikacja przypisania użytkownika do kampanii',
            ],
            'model_mapping.App\Models\MBO\UserObjective' => [
                'pl' => 'Modyfikacja przypisania użytkownika do celu',
            ],
            'route_mapping.App\Models\MBO\ObjectiveTemplate' => [
                'pl' => 'templates.edit',
            ],
            'route_mapping.App\Models\MBO\Objective' => [
                'pl' => 'objectives.show',
            ],
            'route_mapping.App\Models\MBO\Campaign' => [
                'pl' => 'campaigns.show',
            ],
            'route_mapping.App\Models\MBO\UserObjective' => [
                'pl' => 'campaigns.users.update',
            ],
            'route_mapping.App\Models\MBO\UserCampaign' => [
                'pl' => 'campaigns.users.update',
            ],
            'route_mapping.App\Models\MBO\ObjectiveTemplateCategory' => [
                'pl' => 'management.mbo.categories.edit',
            ],
        ];
    }
}
