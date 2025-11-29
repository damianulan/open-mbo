<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Gates extends Seeder
{
    public static function list(): array
    {
        return array(
            'roles_plural' => array(
                'pl' => 'Role',
            ),
            'roles.root' => array(
                'pl' => 'Root',
            ),
            'roles.support' => array(
                'pl' => 'Helpdesk',
            ),
            'roles.admin' => array(
                'pl' => 'Administrator',
            ),
            'roles.admin_mbo' => array(
                'pl' => 'Administrator MBO',
            ),
            'roles.admin_hr' => array(
                'pl' => 'Administrator HR',
            ),
            'roles.manager' => array(
                'pl' => 'Menadżer',
            ),
            'roles.supervisor' => array(
                'pl' => 'Przełożony',
            ),
            'roles.employee' => array(
                'pl' => 'Pracownik',
            ),
            'roles.objective_coordinator' => array(
                'pl' => 'Koordynator kategorii celów',
            ),
            'roles.campaign_coordinator' => array(
                'pl' => 'Koordynator kampanii MBO',
            ),
            'permissions.mbo-administration' => array(
                'pl' => 'Administracja MBO',
            ),
        );
    }
}
