<?php

use App\Enums\MBO\UserObjectiveStatus;

return array(
    'buttons' => array(
        'add_objective' => 'Dodaj cel',
    ),

    'info' => array(
        'no_objectives_added' => 'Nie dodano jeszcze żadnych celów.',
        'no_users_added' => 'Nie dodano jeszcze żadnych użytkowników.',
        'no_c_coordinators_added' => 'Nie dodano jeszcze żadnych koordynatorów dla tej kampanii.',
        'no_category_admins_added' => 'Ta kategoria nie ma swoich administratorów.',
        'objective_admins' => 'Administratorzy przypisani do kategorii celu, mogą zarządzać podległymi sobie celami',
        'campaign_related' => 'Cel powiązany z kampanią: :campaign [:period]',
        'manual_off' => 'Przełączono tryb zapisu na automatyczny.',
        'manual_on' => 'Przełączono tryb zapisu na ręczny.',
        'campaign_stage_changed' => 'Przesunięto etap zapisu na: :stage',
        'objective_not_evaluated_no_users' => 'Żaden użytkownik nie realizuje tego celu.',
        'objective_passed_no_users' => 'Żaden z zapisanych użytkowników nie zaliczył jeszcze tego celu.',
        'objective_failed_no_users' => 'Nie odnotowano żadnych użytkowników, którzy nie zaliczyli tego celu.',
    ),

    'objective_status' => array(
        UserObjectiveStatus::UNSTARTED => 'Nierozpoczęty',
        UserObjectiveStatus::PROGRESS => 'W trakcie',
        UserObjectiveStatus::COMPLETED => 'W rozliczeniu',
        UserObjectiveStatus::PASSED => 'Zaliczony',
        UserObjectiveStatus::FAILED => 'Niezaliczony',
        UserObjectiveStatus::INTERRUPTED => 'Przerwany',
    ),

    'campaign' => 'Kampania',
    'campaigns' => 'Kampanie',
    'campaign_coordinators' => 'Koordynatorzy Kampanii',
    'objective' => 'Cel',
    'objective_admins' => 'Administratorzy Celu',
    'category_admins' => 'Administratorzy Kategorii',
    'enroled_users' => 'Zapisani Użytkownicy',
    'general_objectives' => 'Cele podstawowe',
    'num_participants' => 'Liczba uczestników',
    'linked_to_campaigns' => 'Powiązano z kampaniami',

    'objectives' => array(
        'index' => 'Cele',
        'users' => array(
            'inprogress' => 'Podejścia nierozliczone',
            'completed' => 'Podejścia rozliczone',
        ),

        'pass' => 'Oznacz cel jako zaliczony',
        'fail' => 'Oznacz cel jako niezaliczony',
    ),

    'entities' => array(
        'campaign' => 'Kampania pomiarowa',
    ),
);
