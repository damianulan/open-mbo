<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class MBO extends Seeder
{
    public static function list(): array
    {
        return array(
            'buttons.add_objective' => array(
                'pl' => 'Dodaj cel',
                'en' => 'Add objective',
            ),
            'info.no_objectives_added' => array(
                'pl' => 'Nie dodano jeszcze żadnych celów.',
                'en' => 'No objectives have been added yet.',
            ),
            'info.no_users_added' => array(
                'pl' => 'Nie dodano jeszcze żadnych użytkowników.',
                'en' => 'No users have been added yet.',
            ),
            'info.no_c_coordinators_added' => array(
                'pl' => 'Nie dodano jeszcze żadnych koordynatorów dla tej kampanii.',
                'en' => 'No coordinators have been added yet for this campaign.',
            ),
            'info.no_category_admins_added' => array(
                'pl' => 'Ta kategoria nie ma swoich administratorów.',
                'en' => 'This category has no category administrators.',
            ),
            'info.objective_admins' => array(
                'pl' => 'Administratorzy przypisani do kategorii celu, mogą zarządzać podległymi sobie celami',
                'en' => 'Category objective administrators, they can manage the objectives of their own category',
            ),
            'info.campaign_related' => array(
                'pl' => 'Cel powiązany z kampanią: :campaign [:period]',
                'en' => 'Objective related to campaign: :campaign [:period]',
            ),
            'info.manual_off' => array(
                'pl' => 'Przełączono tryb zapisu na automatyczny.',
                'en' => 'Switched manual mode to automatic.',
            ),
            'info.manual_on' => array(
                'pl' => 'Przełączono tryb zapisu na ręczny.',
                'en' => 'Switched manual mode to manual.',
            ),
            'info.campaign_stage_changed' => array(
                'pl' => 'Przesunięto etap zapisu na: :stage',
                'en' => 'Switched campaign stage to: :stage',
            ),
            'info.objective_not_evaluated_no_users' => array(
                'pl' => 'Żaden użytkownik nie realizuje tego celu.',
                'en' => 'No user has yet realized this objective.',
            ),
            'info.objective_passed_no_users' => array(
                'pl' => 'Żaden z zapisanych użytkowników nie zaliczył jeszcze tego celu.',
                'en' => 'No user has yet passed this objective.',
            ),
            'info.objective_failed_no_users' => array(
                'pl' => 'Nie odnotowano żadnych użytkowników, którzy nie zaliczyli tego celu.',
                'en' => 'No users have yet failed this objective.',
            ),
            'objective_status.unstarted' => array(
                'pl' => 'Nierozpoczęty',
                'en' => 'Unstarted',
            ),
            'objective_status.progress' => array(
                'pl' => 'W trakcie',
                'en' => 'In progress',
            ),
            'objective_status.completed' => array(
                'pl' => 'W rozliczeniu',
                'en' => 'Completed',
            ),
            'objective_status.passed' => array(
                'pl' => 'Zaliczony',
                'en' => 'Passed',
            ),
            'objective_status.failed' => array(
                'pl' => 'Niezaliczony',
                'en' => 'Failed',
            ),
            'objective_status.interrupted' => array(
                'pl' => 'Przerwany',
                'en' => 'Interrupted',
            ),
            'campaign' => array(
                'pl' => 'Kampania',
                'en' => 'Campaign',
            ),
            'campaigns' => array(
                'pl' => 'Kampanie',
                'en' => 'Campaigns',
            ),
            'campaigns_full' => array(
                'pl' => 'Kampanie pomiarowe',
                'en' => 'Campaigns',
            ),
            'campaign_coordinators' => array(
                'pl' => 'Koordynatorzy Kampanii',
                'en' => 'Campaign coordinators',
            ),
            'objective' => array(
                'pl' => 'Cel',
                'en' => 'Objective',
            ),
            'objective_admins' => array(
                'pl' => 'Administratorzy Celu',
                'en' => 'Objective administrators',
            ),
            'category_admins' => array(
                'pl' => 'Administratorzy Kategorii',
                'en' => 'Category administrators',
            ),
            'enroled_users' => array(
                'pl' => 'Zapisani Użytkownicy',
                'en' => 'Enrolled users',
            ),
            'general_objectives' => array(
                'pl' => 'Cele podstawowe',
                'en' => 'General objectives',
            ),
            'num_participants' => array(
                'pl' => 'Liczba uczestników',
                'en' => 'Number of participants',
            ),
            'linked_to_campaigns' => array(
                'pl' => 'Powiązano z kampaniami',
                'en' => 'Linked to campaigns',
            ),
            'rewards' => array(
                'pl' => 'Punkty nagrody',
                'en' => 'Rewards',
            ),
            'objectives.index' => array(
                'pl' => 'Cele',
                'en' => 'Objectives',
            ),
            'objectives.users.inprogress' => array(
                'pl' => 'Podejścia nierozliczone',
                'en' => 'In progress',
            ),
            'objectives.users.completed' => array(
                'pl' => 'Podejścia rozliczone',
                'en' => 'Completed',
            ),
            'objectives.pass' => array(
                'pl' => 'Oznacz cel jako zaliczony',
                'en' => 'Pass',
            ),
            'objectives.fail' => array(
                'pl' => 'Oznacz cel jako niezaliczony',
                'en' => 'Fail',
            ),
            'objectives.passed' => array(
                'pl' => 'Zaliczony',
                'en' => 'Passed',
            ),
            'objectives.failed' => array(
                'pl' => 'Niezaliczony',
                'en' => 'Failed',
            ),
            'entities.campaign' => array(
                'pl' => 'Kampania pomiarowa',
                'en' => 'Campaign',
            ),
            'passed' => array(
                'pl' => 'Zaliczone',
                'en' => 'Passed',
            ),
            'failed' => array(
                'pl' => 'Niezaliczone',
                'en' => 'Failed',
            ),
            'completed' => array(
                'pl' => 'Ukończone',
                'en' => 'Completed',
            ),
            'unstarted' => array(
                'pl' => 'Nierozpoczęte',
                'en' => 'Unstarted',
            ),
            'progress' => array(
                'pl' => 'W trakcie',
                'en' => 'In progress',
            ),
            'uncompleted' => array(
                'pl' => 'Nieukończone',
                'en' => 'Uncompleted',
            ),
            'not_evaluated' => array(
                'pl' => 'Nierozliczone',
                'en' => 'Not evaluated',
            ),
            'evaluated' => array(
                'pl' => 'Rozliczone',
                'en' => 'Evaluated',
            ),
        );
    }
}
