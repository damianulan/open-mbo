<?php

return array(

    'system' => array(
        'unauthorized_module' => 'The module you are trying to access has been blocked by the system administrator.',
    ),
    'success' => array(
        'operation' => 'Operation completed successfully.',
    ),
    'error' => array(
        'invalid_role' => 'You do not have the required system role to perform this action.',
        'no_permission' => 'You do not have the necessary permissions to perform this action.',
        'ajax' => 'An error occurred while fetching data from the server. The request was not processed. Please check your internet connection.',
        'operation' => 'An error occurred while performing the operation.',
        'form' => 'There were errors in the form. Please correct them and try again.',
    ),
    'warning' => array(
        'operation' => 'Warning!',
    ),
    'info' => array(
        'maintenance' => 'The service is closed to users.',
        'env_local' => 'The application is running in local mode.',
        'env_development' => 'The application is running in development mode. Some functionalities may not work as expected.',
        'debugging' => 'Warning - Debugging is enabled.',
    ),

    'settings' => array(

        'success' => array(
            'cache_clear' => 'Application cache has been successfully cleared!',
            'mail_update' => 'SMTP server settings have been updated. Cache was automatically cleared.',
            'mbo_update' => 'MBO module settings have been updated.',
            'general' => 'Platform settings have been updated.',
        ),
        'error' => array(
            'cache_clear' => 'There was an issue clearing the application cache. Check server permissions.',
            'mail_update' => 'SMTP server settings could not be updated. A critical error occurred.',
            'mbo_update' => 'MBO module settings could not be updated. A critical error occurred.',
            'general' => 'Platform settings could not be updated. A critical error occurred.',
        ),

    ),

    'campaigns' => array(
        'success' => array(
            'create' => 'Campaign has been successfully created.',
            'edit' => 'Campaign has been successfully updated.',
            'objective_added' => 'The selected objective has been successfully added to the campaign.',
            'objective_deleted' => 'The objective has been successfully removed from the campaign.',
            'users_added' => 'Campaign user assignments have been successfully updated.',
            'users_deleted' => 'User has been removed from the campaign.',
            'terminate' => 'Campaign has been successfully suspended.',
            'resume' => 'Campaign has been successfully resumed.',
            'cancel' => 'Campaign has been successfully cancelled.',
        ),

        'error' => array(
            'create' => 'The campaign could not be created. An error occurred.',
            'edit' => 'The campaign could not be updated. There were errors in the form.',
            'objective_added' => 'The selected objective could not be added to the campaign.',
            'objective_deleted' => 'The objective could not be removed from the campaign.',
            'users_added' => 'Data could not be updated. Refresh the page and try again.',
            'users_deleted' => 'An error occurred while removing the user from the campaign. Refresh the page and try again.',
            'terminate' => 'Campaign could not be successfully suspended.',
            'resume' => 'Campaign could not be successfully resumed.',
            'cancel' => 'Campaign could not be successfully cancelled.',
        ),
    ),

    'objectives' => array(
        'success' => array(
            'users_added' => 'User assignments to the objective have been successfully updated.',
            'realization_updated' => 'Objective realization data has been successfully updated.',
        ),

        'error' => array(
            'overdued' => 'The deadline for this objective has passed: :term',
            'users_added' => 'Data could not be updated. Refresh the page and try again.',
            'realization_updated' => 'Objective realization data could not be updated. An unexpected error occurred.',
        ),

        'info' => array(
            'delete' => 'Deleting this objective will be irreversible.',
        ),
    ),

    'user_objectives' => array(
        'success' => array(
            'set_passed' => 'Objective has been marked as passed.',
            'set_failed' => 'Objective has been marked as failed.',
        ),
        'error' => array(
            'set_passed' => 'Unable to mark the objective as passed.',
            'set_failed' => 'Unable to mark the objective as failed.',
        ),
    ),

    'users' => array(
        'success' => array(
            'create' => 'A new user has been successfully added to the system.',
            'edit' => 'User :name has been successfully updated.',
            'blocked' => 'User :name has been blocked and no longer has access to the system.',
            'unblocked' => 'User :name has been unblocked and can log back into the system.',
            'delete' => 'User :name has been removed from the system.',
        ),

        'error' => array(
            'create' => 'An error occurred. The user could not be added.',
            'edit' => 'The user could not be updated. An unexpected error occurred during the operation.',
            'delete' => 'User :name could not be removed from the system. An unexpected error occurred during the operation.',
        ),

        'warning' => array(
            'user_is_root' => 'Warning: this user has Root privileges.',
        ),

        'info' => array(
            'block' => 'This action will revoke the user\'s access to the system, and their supervisors may lose certain permissions.',
            'delete' => 'Deleting a user will be irreversible.',
        ),
    ),

    'objective_template' => array(
        'success' => array(
            'create' => 'A new objective template has been successfully added.',
            'edit' => 'Objective template has been successfully updated.',
            'delete' => 'Objective template has been successfully deleted.',
        ),

        'error' => array(
            'create' => 'A new objective template could not be added. An error occurred.',
            'edit' => 'Objective template could not be updated. An error occurred.',
            'delete' => 'Objective template could not be deleted. An error occurred.',
        ),
    ),

    'objective_categories' => array(
        'success' => array(
            'create' => 'A new MBO category has been successfully added.',
            'edit' => 'MBO category has been successfully updated.',
            'delete' => 'MBO category has been successfully deleted.',
        ),

        'error' => array(
            'create' => 'A new MBO category could not be added. An error occurred.',
            'edit' => 'MBO category could not be updated. An error occurred.',
            'delete' => 'MBO category could not be deleted. An error occurred.',
        ),

        'info' => array(
            'delete' => 'Deleting this category will be irreversible. All associated objectives will also be deleted.',
        ),
    ),

    'datatables' => array(
        'save_columns' => array(
            'error_data' => 'No new column display data detected. Changes were not saved.',
            'error' => 'Unable to save new column display data. An error occurred.',
        ),
    ),

);
