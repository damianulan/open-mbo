<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Notifications extends Seeder
{
    public static function list(): array
    {
        return array(
            'app.campaign.coordinator_assignment' => array(
                'pl' => '<strong>:username</strong> to nowy uczestnik kampanii <i class="bi-bullseye"></i> <strong>:campaignname</strong>, którą prowadzisz. Dostępne cele zostały automatycznie przypisane.',
            ),
            'app.campaign.user_assigned' => array(
                'pl' => 'Przypisano Cię do kampanii <i class="bi-bullseye"></i> <strong>:campaignname</strong>.',
            ),
            'info.empty' => array(
                'pl' => 'Twoja skrzynka powiadomień jest pusta, nie otrzymano jeszcze żadnych wiadomości.',
            ),
            'info.show_all' => array(
                'pl' => 'Pokaż wszystkie',
            ),
            'table.key' => array(
                'pl' => 'Identyfikator',
            ),
            'table.system' => array(
                'pl' => 'Powiadomienie systemowe',
            ),
            'table.email' => array(
                'pl' => 'Powiadomienie mailowe',
            ),
            'table.event' => array(
                'pl' => 'Wskutek zdarzenia',
            ),
            'table.schedule' => array(
                'pl' => 'Wysyłka cykliczna',
            ),
            'table.conditions' => array(
                'pl' => 'Wskutek spełnienia warunków',
            ),
            'table.status' => array(
                'pl' => 'Status',
            ),
            'table.action' => array(
                'pl' => 'Akcje',
            ),
        );
    }
}
