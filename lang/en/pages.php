<?php

return [
    'settings' => [
        'server_info' => 'Server info',
        'git_status' => 'Git status',
        'debugging' => 'Debugging',
        'debugbar' => 'DebugBar',
        'environment' => 'Environment',
        'build' => 'Build',
        'release' => 'Release',
        'cache_clear' => 'Clear cache',
        'timezone' => 'Timezone',
        'general' => 'General',
        'branding' => 'Branding',
        'modules' => 'Zarządzanie modułami platformy',
        'phpversion' => 'PHP version',
        'info' => 'PHP Configuration',
        'phpinfo' => 'PHP Info',
        'telescope' => 'Telescope',
    ],

    'home' => [
        'my_objectives' => 'My objectives',
        'my_campaigns' => 'My campaigns',
    ],

    'errors' => [
        '500' => [
            'title' => 'Internal server error',
            'paragraph' => 'The server was unable to process the request. We have registered this incident and are analyzing the source of the error. Thank you.',
        ],
        '503' => [
            'title' => 'Service unavailable',
            'paragraph' => 'Sorry, the service is temporarily unavailable. There are ongoing consultancy work, please try again later. You will be automatically logged out.',
        ],
        '404' => [
            'title' => 'Page not found, or is temporarily unavailable',
            'paragraph' => 'The page you are looking for could not be found.',
        ],
        '403' => [
            'title' => 'Access denied',
            'paragraph' => 'You do not have the necessary permissions to view this page. If this is an error, please contact the system administrator.',
        ],
        '401' => [
            'title' => 'Unauthorized access',
            'paragraph' => '',
        ],
        '419' => [
            'title' => 'Session expired',
            'paragraph' => 'Your secret key is invalid, or your session has expired. Please log in again and try again.',
        ],
        'common' => 'That is probably not a page You were looking for...',

    ],
];
