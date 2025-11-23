<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Notifications extends Seeder
{
    public static function list(): array
    {
        return [
            'app.campaign.coordinator_assignment' => [
                'pl' => '<strong>:username</strong> to nowy uczestnik kampanii <i class="bi-bullseye"></i> <strong>:campaignname</strong>, którą prowadzisz. Dostępne cele zostały automatycznie przypisane.',
            ],
            'app.campaign.user_assigned' => [
                'pl' => 'Przypisano Cię do kampanii <i class="bi-bullseye"></i> <strong>:campaignname</strong>.',
            ],
            'info.empty' => [
                'pl' => 'Twoja skrzynka powiadomień jest pusta, nie otrzymano jeszcze żadnych wiadomości.',
            ],
            'info.show_all' => [
                'pl' => 'Pokaż wszystkie',
            ],
            'table.key' => [
                'pl' => 'Identyfikator',
            ],
            'table.system' => [
                'pl' => 'Powiadomienie systemowe',
            ],
            'table.email' => [
                'pl' => 'Powiadomienie mailowe',
            ],
            'table.event' => [
                'pl' => 'Wskutek zdarzenia',
            ],
            'table.schedule' => [
                'pl' => 'Wysyłka cykliczna',
            ],
            'table.conditions' => [
                'pl' => 'Wskutek spełnienia warunków',
            ],
            'table.status' => [
                'pl' => 'Status',
            ],
            'table.action' => [
                'pl' => 'Akcje',
            ],
        ];
    }
}
