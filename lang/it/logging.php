<?php

return [
    'columns' => [
        'causer' => 'Autore',
        'created_at' => 'Quando',
        'description' => 'Descrizione',
        'event' => 'Evento',
        'subject' => 'Riferito a',
        'subject_type' => 'Tipo di riferimento',
    ],
    'description' => [
        'auth_attempt_fail' => 'A fallito utente login attempt was recorded.',
        'auth_attempt_success' => 'A riuscito utente login attempt was recorded.',
        'auth_logout' => 'Il utente logged out of il system.',
        'created' => 'Utente :username creato a new object instance: :model_map.',
        'deleted' => 'Utente :username eliminato an object instance: :model_map.',
        'notification_sent' => 'Utente :username received notification: :type',
        'updated' => 'Utente :username modificato an object instance: :model_map.',
        'view' => 'Utente :username viewed object: :model_map',
    ],
    'events' => [
        'auth_attempt_fail' => 'Accesso fallito',
        'auth_attempt_success' => 'Successful login',
        'created' => 'Object creato',
        'deleted' => 'Object eliminato',
        'logged_out' => 'Uscita',
        'updated' => 'Data update',
        'viewed' => 'Visualizzazione',
    ],
    'log_name' => [
        'auth' => 'Utente authentication',
        'model' => 'Data change',
        'system' => 'System logs',
    ],
    'model_mapping' => [
        'App\\Models\\MBO\\Campaign' => 'Measurement campaign',
        'App\\Models\\MBO\\Objective' => 'Obiettivo',
        'App\\Models\\MBO\\ObjectiveTemplate' => 'Obiettivo template',
        'App\\Models\\MBO\\ObjectiveTemplateCategory' => 'MBO category',
        'App\\Models\\MBO\\UserCampaign' => 'Modification of utente assignment to campaign',
        'App\\Models\\MBO\\UserObjective' => 'Modification of utente assignment to objective',
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
