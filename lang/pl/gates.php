<?php

use App\Enums\Core\PermissionLib;
use App\Enums\Core\SystemRolesLib;

return [

    // Roles
    'roles_plural' => 'Role',
    'roles' => [
        SystemRolesLib::ROOT => 'Root',
        SystemRolesLib::HELPDESK => 'Helpdesk',
        'admin' => 'Administrator',
        'admin_mbo' => 'Administrator MBO',
        'manager' => 'Menadżer',
        'supervisor' => 'Przełożony',
        'employee' => 'Pracownik',
        'objective_coordinator' => 'Koordynator kategorii celów',
        'campaign_coordinator' => 'Koordynator kampanii MBO',
    ],

    'permissions' => [
        PermissionLib::MBO_ADMINISTRATION => 'Administracja MBO',

        'info' => [],
    ],
];
