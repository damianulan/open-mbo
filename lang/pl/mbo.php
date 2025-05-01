<?php

use App\Enums\MBO\UserObjectiveStatus;

return [
    'buttons' => [
        'add_objective' => 'Dodaj cel',
    ],

    'info' => [
        'no_objectives_added' => 'Nie dodano jeszcze żadnych celów.',
        'no_users_added' => 'Nie dodano jeszcze żadnych użytkowników.',
        'no_c_coordinators_added' => 'Nie dodano jeszcze żadnych koordynatorów dla tej kampanii.',
        'no_category_admins_added' => 'Ta kategoria nie ma swoich administratorów.',
        'objective_admins' => 'Administratorzy przypisani do kategorii celu, mogą zarządzać podległymi sobie celami',
        'campaign_related' => 'Cel powiązany z kampanią: :campaign [:period]',
        'manual_off' => 'Przełączono tryb zapisu na automatyczny.',
        'manual_on' => 'Przełączono tryb zapisu na ręczny.',
        'campaign_stage_changed' => 'Przesunięto etap zapisu na: :stage',
    ],

    'objective_status' => [
        UserObjectiveStatus::UNSTARTED => 'Nierozpoczęte',
        UserObjectiveStatus::PROGRESS => 'W trakcie',
        UserObjectiveStatus::COMPLETED => 'Zakończone',
        UserObjectiveStatus::PASSED => 'Zaliczone',
        UserObjectiveStatus::FAILED => 'Niezaliczone',
    ],

    'campaign' => 'Kampania',
    'campaigns' => 'Kampanie',
    'campaign_coordinators' => 'Koordynatorzy Kampanii',
    'objective' => 'Cel',
    'objective_admins' => 'Administratorzy Celu',
    'category_admins' => 'Administratorzy Kategorii',
    'enroled_users' => 'Zapisani Użytkownicy',

    'objectives' => [
        'index' => 'Cele',
        'users' => [
            'inprogress' => 'W trakcie realizacji celu',
            'completed' => 'Podejścia zakończone',
        ],
    ],

];
