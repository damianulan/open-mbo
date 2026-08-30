<?php

return [
    'columns' => [
        'causer' => 'Initiator',
        'created_at' => 'When',
        'description' => 'Description',
        'event' => 'Event',
        'subject' => 'Refers to',
        'subject_type' => 'Refers to type',
    ],
    'description' => [
        'auth_attempt_fail' => 'A failed user login attempt was recorded.',
        'auth_attempt_success' => 'A successful user login attempt was recorded.',
        'auth_logout' => 'The user logged out of the system.',
        'created' => 'User :username created a new object instance: :model_map.',
        'deleted' => 'User :username deleted an object instance: :model_map.',
        'notification_sent' => 'User :username received notification: :type',
        'updated' => 'User :username modified an object instance: :model_map.',
        'view' => 'User :username viewed object: :model_map',
    ],
    'events' => [
        'auth_attempt_fail' => 'Login failure',
        'auth_attempt_success' => 'Successful login',
        'created' => 'Object created',
        'deleted' => 'Object deleted',
        'logged_out' => 'Logout',
        'updated' => 'Data update',
        'viewed' => 'Showing',
    ],
    'log_name' => [
        'auth' => 'User authentication',
        'model' => 'Data change',
        'system' => 'System logs',
    ],
    'model_mapping' => [
        'App\\Models\\MBO\\Campaign' => 'Measurement campaign',
        'App\\Models\\MBO\\Objective' => 'Objective',
        'App\\Models\\MBO\\ObjectiveTemplate' => 'Objective template',
        'App\\Models\\MBO\\ObjectiveTemplateCategory' => 'MBO category',
        'App\\Models\\MBO\\UserCampaign' => 'Modification of user assignment to campaign',
        'App\\Models\\MBO\\UserObjective' => 'Modification of user assignment to objective',
    ],
    'route_mapping' => [
        'App\\Models\\MBO\\Campaign' => 'campaigns.show route',
        'App\\Models\\MBO\\Objective' => 'objectives.show route',
        'App\\Models\\MBO\\ObjectiveTemplate' => 'templates.edit route',
        'App\\Models\\MBO\\ObjectiveTemplateCategory' => 'management.mbo.categories.edit route',
        'App\\Models\\MBO\\UserCampaign' => 'campaigns.users.update route',
        'App\\Models\\MBO\\UserObjective' => 'campaigns.users.update route (objective)',
    ],
];
