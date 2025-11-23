<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class MBO extends Seeder
{
    public static function list(): array
    {
        return [
            'buttons.add_objective' => [
                'pl' => 'Dodaj cel',
                'en' => 'Add objective',
            ],
            'info.no_objectives_added' => [
                'pl' => 'Nie dodano jeszcze żadnych celów.',
                'en' => 'No objectives have been added yet.',
            ],
            'info.no_users_added' => [
                'pl' => 'Nie dodano jeszcze żadnych użytkowników.',
                'en' => 'No users have been added yet.',
            ],
            'info.no_c_coordinators_added' => [
                'pl' => 'Nie dodano jeszcze żadnych koordynatorów dla tej kampanii.',
                'en' => 'No coordinators have been added yet for this campaign.',
            ],
            'info.no_category_admins_added' => [
                'pl' => 'Ta kategoria nie ma swoich administratorów.',
                'en' => 'This category has no category administrators.',
            ],
            'info.objective_admins' => [
                'pl' => 'Administratorzy przypisani do kategorii celu, mogą zarządzać podległymi sobie celami',
                'en' => 'Category objective administrators, they can manage the objectives of their own category',
            ],
            'info.campaign_related' => [
                'pl' => 'Cel powiązany z kampanią: :campaign [:period]',
                'en' => 'Objective related to campaign: :campaign [:period]',
            ],
            'info.manual_off' => [
                'pl' => 'Przełączono tryb zapisu na automatyczny.',
                'en' => 'Switched manual mode to automatic.',
            ],
            'info.manual_on' => [
                'pl' => 'Przełączono tryb zapisu na ręczny.',
                'en' => 'Switched manual mode to manual.',
            ],
            'info.campaign_stage_changed' => [
                'pl' => 'Przesunięto etap zapisu na: :stage',
                'en' => 'Switched campaign stage to: :stage',
            ],
            'info.objective_not_evaluated_no_users' => [
                'pl' => 'Żaden użytkownik nie realizuje tego celu.',
                'en' => 'No user has yet realized this objective.',
            ],
            'info.objective_passed_no_users' => [
                'pl' => 'Żaden z zapisanych użytkowników nie zaliczył jeszcze tego celu.',
                'en' => 'No user has yet passed this objective.',
            ],
            'info.objective_failed_no_users' => [
                'pl' => 'Nie odnotowano żadnych użytkowników, którzy nie zaliczyli tego celu.',
                'en' => 'No users have yet failed this objective.',
            ],
            'objective_status.unstarted' => [
                'pl' => 'Nierozpoczęty',
                'en' => 'Unstarted',
            ],
            'objective_status.progress' => [
                'pl' => 'W trakcie',
                'en' => 'In progress',
            ],
            'objective_status.completed' => [
                'pl' => 'W rozliczeniu',
                'en' => 'Completed',
            ],
            'objective_status.passed' => [
                'pl' => 'Zaliczony',
                'en' => 'Passed',
            ],
            'objective_status.failed' => [
                'pl' => 'Niezaliczony',
                'en' => 'Failed',
            ],
            'objective_status.interrupted' => [
                'pl' => 'Przerwany',
                'en' => 'Interrupted',
            ],
            'campaign' => [
                'pl' => 'Kampania',
                'en' => 'Campaign',
            ],
            'campaigns' => [
                'pl' => 'Kampanie',
                'en' => 'Campaigns',
            ],
            'campaigns_full' => [
                'pl' => 'Kampanie pomiarowe',
                'en' => 'Campaigns',
            ],
            'campaign_coordinators' => [
                'pl' => 'Koordynatorzy Kampanii',
                'en' => 'Campaign coordinators',
            ],
            'objective' => [
                'pl' => 'Cel',
                'en' => 'Objective',
            ],
            'objective_admins' => [
                'pl' => 'Administratorzy Celu',
                'en' => 'Objective administrators',
            ],
            'category_admins' => [
                'pl' => 'Administratorzy Kategorii',
                'en' => 'Category administrators',
            ],
            'enroled_users' => [
                'pl' => 'Zapisani Użytkownicy',
                'en' => 'Enrolled users',
            ],
            'general_objectives' => [
                'pl' => 'Cele podstawowe',
                'en' => 'General objectives',
            ],
            'num_participants' => [
                'pl' => 'Liczba uczestników',
                'en' => 'Number of participants',
            ],
            'linked_to_campaigns' => [
                'pl' => 'Powiązano z kampaniami',
                'en' => 'Linked to campaigns',
            ],
            'rewards' => [
                'pl' => 'Punkty nagrody',
                'en' => 'Rewards',
            ],
            'objectives.index' => [
                'pl' => 'Cele',
                'en' => 'Objectives',
            ],
            'objectives.users.inprogress' => [
                'pl' => 'Podejścia nierozliczone',
                'en' => 'In progress',
            ],
            'objectives.users.completed' => [
                'pl' => 'Podejścia rozliczone',
                'en' => 'Completed',
            ],
            'objectives.pass' => [
                'pl' => 'Oznacz cel jako zaliczony',
                'en' => 'Pass',
            ],
            'objectives.fail' => [
                'pl' => 'Oznacz cel jako niezaliczony',
                'en' => 'Fail',
            ],
            'objectives.passed' => [
                'pl' => 'Zaliczony',
                'en' => 'Passed',
            ],
            'objectives.failed' => [
                'pl' => 'Niezaliczony',
                'en' => 'Failed',
            ],
            'entities.campaign' => [
                'pl' => 'Kampania pomiarowa',
                'en' => 'Campaign',
            ],
            'passed' => [
                'pl' => 'Zaliczone',
                'en' => 'Passed',
            ],
            'failed' => [
                'pl' => 'Niezaliczone',
                'en' => 'Failed',
            ],
            'completed' => [
                'pl' => 'Ukończone',
                'en' => 'Completed',
            ],
            'unstarted' => [
                'pl' => 'Nierozpoczęte',
                'en' => 'Unstarted',
            ],
            'progress' => [
                'pl' => 'W trakcie',
                'en' => 'In progress',
            ],
            'uncompleted' => [
                'pl' => 'Nieukończone',
                'en' => 'Uncompleted',
            ],
            'not_evaluated' => [
                'pl' => 'Nierozliczone',
                'en' => 'Not evaluated',
            ],
            'evaluated' => [
                'pl' => 'Rozliczone',
                'en' => 'Evaluated',
            ],
        ];
    }
}
