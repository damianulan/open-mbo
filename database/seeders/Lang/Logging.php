<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Logging extends Seeder
{
    public static function list(): array
    {
        return array(
            'columns.causer' => array(
                'pl' => 'Inicjator',
            ),
            'columns.subject' => array(
                'pl' => 'Odnosi się do',
            ),
            'columns.subject_type' => array(
                'pl' => 'Odnosi się do typu',
            ),
            'columns.created_at' => array(
                'pl' => 'Kiedy',
            ),
            'columns.event' => array(
                'pl' => 'Zdarzenie',
            ),
            'columns.description' => array(
                'pl' => 'Opis',
            ),
            'events.viewed' => array(
                'pl' => 'Wyświetlono',
            ),
            'events.created' => array(
                'pl' => 'Utworzenie obiektu',
            ),
            'events.updated' => array(
                'pl' => 'Aktualizacja danych',
            ),
            'events.logged_out' => array(
                'pl' => 'Wylogowanie',
            ),
            'events.auth_attempt_success' => array(
                'pl' => 'Pomyślnie logowanie',
            ),
            'events.auth_attempt_fail' => array(
                'pl' => 'Niepowodzenie logowania',
            ),
            'events.deleted' => array(
                'pl' => 'Usunięcie obiektu',
            ),
            'log_name.system' => array(
                'pl' => 'System',
            ),
            'log_name.auth' => array(
                'pl' => 'Identyfikacja użytkownika',
            ),
            'log_name.model' => array(
                'pl' => 'Zmiana danych',
            ),
            'description.created' => array(
                'pl' => 'Użytkownik :username utworzył nową instancję obiektu: :model_map.',
            ),
            'description.updated' => array(
                'pl' => 'Użytkownik :username zmodyfikował instancję obiektu: :model_map.',
            ),
            'description.deleted' => array(
                'pl' => 'Użytkownik :username usunął instancję obiektu: :model_map.',
            ),
            'description.auth_attempt_success' => array(
                'pl' => 'Zarejestrowano pomyślną próbę logowania użytkownika.',
            ),
            'description.auth_attempt_fail' => array(
                'pl' => 'Zarejestrowano próbę logowania użytkownika zakończoną niepowodzeniem.',
            ),
            'description.auth_logout' => array(
                'pl' => 'Użytkownik wylogował się z systemu.',
            ),
            'description.notification_sent' => array(
                'pl' => 'Użytkownik :username otrzymał powiadomienie: :type',
            ),
            'description.view' => array(
                'pl' => 'Użytkownik :username wyświetlił obiekt: :model_map',
            ),
            'model_mapping.App\Models\MBO\ObjectiveTemplate' => array(
                'pl' => 'Szablon celu',
            ),
            'model_mapping.App\Models\MBO\Objective' => array(
                'pl' => 'Cel',
            ),
            'model_mapping.App\Models\MBO\Campaign' => array(
                'pl' => 'Kampania pomiarowa',
            ),
            'model_mapping.App\Models\MBO\ObjectiveTemplateCategory' => array(
                'pl' => 'Kategoria MBO',
            ),
            'model_mapping.App\Models\MBO\UserCampaign' => array(
                'pl' => 'Modyfikacja przypisania użytkownika do kampanii',
            ),
            'model_mapping.App\Models\MBO\UserObjective' => array(
                'pl' => 'Modyfikacja przypisania użytkownika do celu',
            ),
            'route_mapping.App\Models\MBO\ObjectiveTemplate' => array(
                'pl' => 'templates.edit',
            ),
            'route_mapping.App\Models\MBO\Objective' => array(
                'pl' => 'objectives.show',
            ),
            'route_mapping.App\Models\MBO\Campaign' => array(
                'pl' => 'campaigns.show',
            ),
            'route_mapping.App\Models\MBO\UserObjective' => array(
                'pl' => 'campaigns.users.update',
            ),
            'route_mapping.App\Models\MBO\UserCampaign' => array(
                'pl' => 'campaigns.users.update',
            ),
            'route_mapping.App\Models\MBO\ObjectiveTemplateCategory' => array(
                'pl' => 'management.mbo.categories.edit',
            ),
        );
    }
}
