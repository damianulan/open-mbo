<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Gates extends Seeder
{
    public static function list(): array
    {
        return [
            'roles_plural' => [
                'pl' => 'Role',
            ],
            'roles.root' => [
                'pl' => 'Root',
            ],
            'roles.support' => [
                'pl' => 'Helpdesk',
            ],
            'roles.admin' => [
                'pl' => 'Administrator',
            ],
            'roles.admin_mbo' => [
                'pl' => 'Administrator MBO',
            ],
            'roles.admin_hr' => [
                'pl' => 'Administrator HR',
            ],
            'roles.manager' => [
                'pl' => 'Menadżer',
            ],
            'roles.supervisor' => [
                'pl' => 'Przełożony',
            ],
            'roles.employee' => [
                'pl' => 'Pracownik',
            ],
            'roles.objective_coordinator' => [
                'pl' => 'Koordynator kategorii celów',
            ],
            'roles.campaign_coordinator' => [
                'pl' => 'Koordynator kampanii MBO',
            ],
            'permissions.mbo-administration' => [
                'pl' => 'Administracja MBO',
            ],
        ];
    }
}
