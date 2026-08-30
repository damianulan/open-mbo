<?php

return [
    'campaigns' => [
        'error' => [
            'cancel' => 'Campaign was not successfully cancelled.',
            'create' => 'The campaign could not be added. An error occurred.',
            'edit' => 'The campaign was not modified. There are errors in the form.',
            'objective_added' => 'The selected objective was successfully added to the campaign.',
            'objective_deleted' => 'The objective was successfully removed from the campaign.',
            'resume' => 'The campaign was not successfully resumed.',
            'terminate' => 'The campaign was not successfully suspended.',
            'users_added' => 'Data was not updated. Refresh the page and try again.',
            'users_deleted' => 'An error occurred while removing the user from the campaign. Refresh the page and try again.',
        ],
        'success' => [
            'cancel' => 'The campaign was successfully canceled.',
            'create' => 'The campaign was created successfully.',
            'edit' => 'The campaign was modified successfully.',
            'objective_added' => 'The selected objective was successfully added to the campaign.',
            'objective_deleted' => 'The objective was successfully removed from the campaign.',
            'resume' => 'The campaign was successfully resumed.',
            'terminate' => 'The campaign was successfully suspended.',
            'users_added' => 'Campaign staffing has been updated.',
            'users_deleted' => 'The user was removed from the campaign.',
        ],
    ],
    'companies' => [
        'info' => [
            'delete' => 'Deleting the company is irreversible.',
        ],
    ],
    'contracts' => [
        'info' => [
            'delete' => 'Deleting the contract type is irreversible.',
        ],
    ],
    'datatables' => [
        'save_columns' => [
            'error' => 'Could not save new table column settings. An error occurred.',
            'error_data' => 'No new table column display settings were detected. Changes were not saved.',
        ],
    ],
    'departments' => [
        'info' => [
            'delete' => 'Deleting the department is irreversible.',
        ],
    ],
    'employments' => [
        'error' => [
            'create' => 'The new employment record could not be added. An error occurred.',
            'delete' => 'The employment record could not be deleted. An error occurred.',
            'edit' => 'The employment record could not be modified. An error occurred.',
        ],
        'success' => [
            'create' => 'The new employment record was added successfully.',
            'delete' => 'The employment record was deleted successfully.',
            'edit' => 'The employment record was modified successfully.',
        ],
    ],
    'success' => [
        'operation' => 'Operation completed successfully.',
    ],
    'error' => [
        'ajax' => 'An error occurred while downloading data from the server, and the request was not processed. Check your internet connection.',
        'form' => 'There are errors in the form. Correct them and try again.',
        'invalid_role' => 'You do not have the required system role to perform this action.',
        'no_permission' => 'You do not have sufficient permissions to perform this action.',
        'operation' => 'An error occurred while performing the operation.',
        'unauthorized_access' => 'You do not have permission to perform this action.',
    ],
    'info' => [
        'debugging' => 'Warning - Debug mode is enabled',
        'env_development' => 'The application is running in development mode. Some functionality may not work as expected.',
        'env_local' => 'The application is running in local mode',
        'maintenance' => 'The service is closed for users.',
    ],
    'objective_categories' => [
        'error' => [
            'create' => 'The new MBO category could not be added. An error occurred.',
            'delete' => 'The MBO category could not be deleted. An error occurred.',
            'edit' => 'The MBO category was not modified. An error occurred.',
        ],
        'info' => [
            'delete' => 'Deleting the category is irreversible. All related objectives will also be deleted.',
        ],
        'success' => [
            'create' => 'The new MBO category was added successfully.',
            'delete' => 'The MBO category was deleted successfully.',
            'edit' => 'The MBO category was modified successfully.',
        ],
    ],
    'positions' => [
        'info' => [
            'delete' => 'Deleting the position is irreversible.',
        ],
    ],
    'notifications' => [
        'info' => [
            'delete' => 'Deleting the notification is irreversible.',
        ],
    ],
    'objective_template' => [
        'error' => [
            'create' => 'The new objective template could not be added. An error occurred.',
            'delete' => 'The objective template could not be deleted. An error occurred.',
            'edit' => 'The objective template was not modified. An error occurred.',
        ],
        'success' => [
            'create' => 'The new objective template was added successfully.',
            'delete' => 'The objective template was deleted successfully.',
            'edit' => 'The objective template was modified successfully.',
        ],
    ],
    'objectives' => [
        'error' => [
            'overdued' => 'The deadline for this objective has passed :term',
            'realization_updated' => 'Objective progress data could not be updated. An unexpected error occurred.',
            'users_added' => 'Data was not updated. Refresh the page and try again.',
        ],
        'info' => [
            'delete' => 'Deleting the objective is irreversible.',
        ],
        'success' => [
            'realization_updated' => 'Objective progress data has been updated.',
            'users_added' => 'User assignments to the objective have been updated.',
        ],
    ],
    'settings' => [
        'error' => [
            'cache_clear' => 'The server encountered problems while clearing the application cache. Check server permissions.',
            'general' => 'Platform settings could not be updated. A critical error occurred.',
            'mail_update' => 'SMTP server data could not be updated. A critical error occurred.',
            'update' => 'Module settings could not be updated. A critical error occurred.',
        ],
        'success' => [
            'cache_clear' => 'The application cache was cleared successfully!',
            'general' => 'Platform settings have been updated.',
            'mail_update' => 'SMTP server data has been updated. Cache was cleared automatically.',
            'update' => 'Module settings have been updated.',
        ],
    ],
    'system' => [
        'unauthorized_module' => 'The module you are trying to open has been blocked by the system administrator.',
    ],
    'user_objectives' => [
        'error' => [
            'set_failed' => 'The objective cannot be marked as failed.',
            'set_passed' => 'The objective cannot be marked as passed.',
        ],
        'success' => [
            'set_failed' => 'The objective has been marked as failed.',
            'set_passed' => 'The objective has been marked as passed.',
        ],
    ],
    'users' => [
        'error' => [
            'create' => 'An error occurred, the user could not be added.',
            'delete' => 'User :name could not be removed from the system. An unexpected error occurred during the operation.',
            'edit' => 'The user could not be modified. An unexpected error occurred during the operation.',
        ],
        'info' => [
            'block' => 'As a result of this action, the user will lose access to the system, and their supervisors may lose some privileges.',
            'delete' => 'Deleting the user is irreversible.',
        ],
        'success' => [
            'blocked' => 'User :name has been blocked. They no longer have access to the system.',
            'create' => 'A new user has been added to the system successfully.',
            'delete' => 'User :name has been removed from the system.',
            'edit' => 'User :name has been modified successfully.',
            'unblocked' => 'User :name has been unblocked. They can log in to the system again.',
        ],
        'warning' => [
            'user_is_root' => 'Warning, this user has Root privileges.',
        ],
    ],
    'warning' => [
        'operation' => 'Warning!',
    ],
    'teams' => [
        'info' => [
            'delete' => 'Deleting the team is irreversible.',
        ],
    ],
];
