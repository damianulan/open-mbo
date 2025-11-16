<?php

use App\Warden\PermissionsLib;
use App\Warden\RolesLib;

return array(

    // Roles
    'roles_plural' => 'Roles',
    'roles' => array(
        RolesLib::ROOT => 'Root',
        RolesLib::HELPDESK => 'Helpdesk',
        RolesLib::ADMIN => 'Admin',
        RolesLib::ADMIN_MBO => 'MBO Admin',
        RolesLib::ADMIN_HR => 'HR Admin',
        RolesLib::MANAGER => 'Manager',
        RolesLib::SUPERVISOR => 'Supervisor',
        RolesLib::EMPLOYEE => 'Employee',
        RolesLib::OBJECTIVE_COORDINATOR => 'Objective Coordinator',
        RolesLib::CAMPAIGN_COORDINATOR => 'Campaign Coordinator',
    ),

    'permissions' => array(
        PermissionsLib::MBO_ADMINISTRATION => 'MBO Administration',
    ),
);
