<?php

return [
    'errors' => [
        '401' => [
            'paragraph' => 'Non sei autorizzato ad accedere a questa pagina.',
            'title' => 'Accesso non autorizzato',
        ],
        '403' => [
            'paragraph' => 'Non disponi dei permessi necessari per visualizzare questa pagina. Se si tratta di un errore, contatta l’amministratore di sistema.',
            'title' => 'Accesso negato',
        ],
        '404' => [
            'paragraph' => 'La pagina che stai cercando non è stata trovata.',
            'title' => 'Pagina non trovata, o temporaneamente non disponibile',
        ],
        '419' => [
            'paragraph' => 'La tua chiave segreta non è valida o la sessione è scaduta. Accedi di nuovo e riprova.',
            'title' => 'Sessione scaduta',
        ],
        '500' => [
            'paragraph' => 'Il server non è riuscito a elaborare la richiesta. Abbiamo registrato questo incidente e stiamo analizzando la causa dell’errore. Grazie.',
            'title' => 'Errore interno del server',
        ],
        '503' => [
            'paragraph' => 'Spiacenti, il servizio è temporaneamente non disponibile. Sono in corso attività di manutenzione, riprova più tardi. Verrai disconnesso automaticamente.',
            'title' => 'Servizio non disponibile',
        ],
        'common' => 'Questa non è la pagina che stai cercando...',
    ],
    'home' => [
        'my_campaigns' => 'Le mie campagne',
        'my_objectives' => 'I miei obiettivi',
        'my_points' => 'I miei punti',
    ],
    'settings' => [
        'branding' => 'Impostazioni branding',
        'build' => 'Versione build',
        'cache_clear' => 'Svuota cache',
        'debugbar' => 'DebugBar',
        'debugging' => 'Modalità debug',
        'environment' => 'Ambiente',
        'general' => 'Generali',
        'git_status' => 'Stato repository Git',
        'info' => 'Informazioni PHP',
        'modules' => 'Gestisci moduli piattaforma',
        'phpinfo' => 'Informazioni PHP',
        'phpversion' => 'Versione PHP',
        'release' => 'Rilascio',
        'server_info' => 'Informazioni server',
        'telescope' => 'Telescope',
        'timezone' => 'Fuso orario',
        'app' => 'Impostazioni dell\'applicazione',
        'smtp_server' => 'Server di posta in uscita (SMTP)',
    ],
];
