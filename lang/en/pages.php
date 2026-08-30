<?php

return [
    'errors' => [
        '401' => [
            'paragraph' => 'You are not authorized to access this page.',
            'title' => 'Unauthorized access',
        ],
        '403' => [
            'paragraph' => 'You do not have the necessary permissions to display this page. If this is an error, please contact the system administrator.',
            'title' => 'Access denied',
        ],
        '404' => [
            'paragraph' => 'The page you are looking for could not be found.',
            'title' => 'Page not found, or it is temporarily unavailable',
        ],
        '419' => [
            'paragraph' => 'Your secret key is invalid or your session has expired. Please log in again and try again.',
            'title' => 'Session expired',
        ],
        '500' => [
            'paragraph' => 'The server was unable to process the request. We have registered this incident and are analyzing the source of the error. Thank you.',
            'title' => 'Internal server error',
        ],
        '503' => [
            'paragraph' => 'Sorry, the service is temporarily unavailable. There are ongoing consultancy work, please try again later. You will be automatically logged out.',
            'title' => 'Service unavailable',
        ],
        'common' => 'This is not the page you are looking for...',
    ],
    'home' => [
        'my_campaigns' => 'My campaigns',
        'my_objectives' => 'My objectives',
        'my_points' => 'My points',
    ],
    'settings' => [
        'branding' => 'Branding settings',
        'build' => 'Build version',
        'cache_clear' => 'Clear cache',
        'debugbar' => 'DebugBar',
        'debugging' => 'Debug mode',
        'environment' => 'Environment',
        'general' => 'General',
        'git_status' => 'Git repository status',
        'info' => 'PHP info',
        'modules' => 'Manage platform modules',
        'phpinfo' => 'PHP info',
        'phpversion' => 'PHP version',
        'release' => 'Release',
        'server_info' => 'Server info',
        'telescope' => 'Telescope',
        'timezone' => 'Timezone',
        'app' => 'Application settings',
        'smtp_server' => 'Outgoing mail server (SMTP)',
    ],
];
