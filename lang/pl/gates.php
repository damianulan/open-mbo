<?php

use App\Warden\PermissionsLib;
use App\Warden\RolesLib;

return array(

    // Roles
    'roles_plural' => 'Role',
    'roles' => array(
        RolesLib::ROOT => 'Root',
        RolesLib::HELPDESK => 'Helpdesk',
        RolesLib::ADMIN => 'Administrator',
        RolesLib::ADMIN_MBO => 'Administrator MBO',
        RolesLib::ADMIN_HR => 'Administrator HR',
        RolesLib::MANAGER => 'Menadżer',
        RolesLib::SUPERVISOR => 'Przełożony',
        RolesLib::EMPLOYEE => 'Pracownik',
        RolesLib::OBJECTIVE_COORDINATOR => 'Koordynator kategorii celów',
        RolesLib::CAMPAIGN_COORDINATOR => 'Koordynator kampanii MBO',
    ),

    'permissions' => array(
        PermissionsLib::MBO_ADMINISTRATION => 'Administracja MBO',
    ),
);
