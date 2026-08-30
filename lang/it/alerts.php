<?php

return [
    'campaigns' => [
        'error' => [
            'cancel' => 'La campagna non è stata annullata correttamente.',
            'create' => 'La campagna non è stata aggiunta. Si è verificato un errore.',
            'edit' => 'La campagna non è stata modificata. Ci sono errori nel modulo.',
            'objective_added' => 'L’obiettivo selezionato è stato aggiunto con successo alla campagna.',
            'objective_deleted' => 'L’obiettivo è stato rimosso con successo dalla campagna.',
            'resume' => 'La campagna non è stata ripresa correttamente.',
            'terminate' => 'La campagna non è stata sospesa correttamente.',
            'users_added' => 'I dati non sono stati aggiornati. Aggiorna la pagina e riprova.',
            'users_deleted' => 'Si è verificato un errore durante la rimozione dell’utente dalla campagna. Aggiorna la pagina e riprova.',
        ],
        'success' => [
            'cancel' => 'La campagna was con successo annullato.',
            'create' => 'La campagna was creato con successo.',
            'edit' => 'La campagna was modificato con successo.',
            'objective_added' => 'L’obiettivo selezionato è stato aggiunto con successo alla campagna.',
            'objective_deleted' => 'L’obiettivo è stato rimosso con successo dalla campagna.',
            'resume' => 'La campagna was con successo ripreso.',
            'terminate' => 'La campagna was con successo sospeso.',
            'users_added' => 'La composizione della campagna è stata aggiornata.',
            'users_deleted' => 'L’utente è stato rimosso dalla campagna.',
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
            'error' => 'Impossibile salvare le nuove impostazioni delle colonne della tabella. Si è verificato un errore.',
            'error_data' => 'Non sono state rilevate nuove impostazioni di visualizzazione delle colonne della tabella. Le modifiche non sono state salvate.',
        ],
    ],
    'departments' => [
        'info' => [
            'delete' => 'Deleting the department is irreversible.',
        ],
    ],
    'employments' => [
        'error' => [
            'create' => 'Il nuovo record di impiego non è stato aggiunto. Si è verificato un errore.',
            'delete' => 'Il record di impiego non è stato eliminato. Si è verificato un errore.',
            'edit' => 'Il record di impiego non è stato modificato. Si è verificato un errore.',
        ],
        'success' => [
            'create' => 'Il nuovo record di impiego è stato aggiunto con successo.',
            'delete' => 'Il record di impiego è stato eliminato con successo.',
            'edit' => 'Il record di impiego è stato modificato con successo.',
        ],
    ],
    'success' => [
        'operation' => 'Operazione completata con successo.',
    ],
    'error' => [
        'ajax' => 'Si è verificato un errore durante il download dei dati dal server e la richiesta non è stata elaborata. Verifica la tua connessione Internet.',
        'form' => 'Ci sono errori nel modulo. Correggili e riprova.',
        'invalid_role' => 'Non hai il ruolo di sistema richiesto per eseguire questa azione.',
        'no_permission' => 'Non hai autorizzazioni sufficienti per eseguire questa azione.',
        'operation' => 'An errore occurred while performing il operation.',
        'unauthorized_access' => 'Non hai il permesso di eseguire questa azione.',
    ],
    'info' => [
        'debugging' => 'Attenzione - La modalità debug è attiva',
        'env_development' => 'L’applicazione è in esecuzione in modalità sviluppo. Alcune funzionalità potrebbero non funzionare come previsto.',
        'env_local' => 'L’applicazione è in esecuzione in modalità locale',
        'maintenance' => 'Il servizio è chiuso per gli utenti.',
    ],
    'objective_categories' => [
        'error' => [
            'create' => 'La nuova categoria MBO non è stata aggiunta. Si è verificato un errore.',
            'delete' => 'La categoria MBO non è stata eliminata. Si è verificato un errore.',
            'edit' => 'Il MBO category was not modificato. An errore occurred.',
        ],
        'info' => [
            'delete' => 'Deleting il category is irreversible. All related obiettivi will also be eliminato.',
        ],
        'success' => [
            'create' => 'Il new MBO category was aggiunto con successo.',
            'delete' => 'La categoria MBO è stata eliminata con successo.',
            'edit' => 'La categoria MBO è stata modificata con successo.',
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
            'create' => 'Il new obiettivo template non è stato possibile be aggiunto. An errore occurred.',
            'delete' => 'Il modello obiettivo non è stato eliminato. Si è verificato un errore.',
            'edit' => 'Il obiettivo template was not modificato. An errore occurred.',
        ],
        'success' => [
            'create' => 'Il new obiettivo template was aggiunto con successo.',
            'delete' => 'Il modello obiettivo è stato eliminato con successo.',
            'edit' => 'Il modello obiettivo è stato modificato con successo.',
        ],
    ],
    'objectives' => [
        'error' => [
            'overdued' => 'Il deadline for this obiettivo has passed :term',
            'realization_updated' => 'I dati di avanzamento dell’obiettivo non sono stati aggiornati. Si è verificato un errore imprevisto.',
            'users_added' => 'I dati non sono stati aggiornati. Aggiorna la pagina e riprova.',
        ],
        'info' => [
            'delete' => 'Deleting il obiettivo is irreversible.',
        ],
        'success' => [
            'realization_updated' => 'Obiettivo progress data has been aggiornato.',
            'users_added' => 'Utente assignments to il obiettivo have been aggiornato.',
        ],
    ],
    'settings' => [
        'error' => [
            'cache_clear' => 'Il server encountered problems while clearing il application cache. Check server permessi.',
            'general' => 'Platmodulo impostazioni non è stato possibile be aggiornato. A critical errore occurred.',
            'mail_update' => 'SMTP server data non è stato possibile be aggiornato. A critical errore occurred.',
            'update' => 'Module impostazioni non è stato possibile be aggiornato. A critical errore occurred.',
        ],
        'success' => [
            'cache_clear' => 'Il application cache was cleared con successo!',
            'general' => 'Le impostazioni della piattaforma sono state aggiornate.',
            'mail_update' => 'SMTP server data has been aggiornato. Cache was cleared automatically.',
            'update' => 'Module impostazioni have been aggiornato.',
        ],
    ],
    'system' => [
        'unauthorized_module' => 'Il modulo you are trying to open has been blocked by il system administrator.',
    ],
    'user_objectives' => [
        'error' => [
            'set_failed' => 'Il obiettivo non può be marked as fallito.',
            'set_passed' => 'Il obiettivo non può be marked as passed.',
        ],
        'success' => [
            'set_failed' => 'Il obiettivo has been marked as fallito.',
            'set_passed' => 'Il obiettivo has been marked as passed.',
        ],
    ],
    'users' => [
        'error' => [
            'create' => 'An errore occurred, il utente non è stato possibile be aggiunto.',
            'delete' => 'Utente :name non è stato possibile be rimosso from il system. An unexpected errore occurred during il operation.',
            'edit' => 'Il utente non è stato possibile be modificato. An unexpected errore occurred during il operation.',
        ],
        'info' => [
            'block' => 'As a result of this action, il utente will lose access to il system, and their supervisors may lose some privileges.',
            'delete' => 'Deleting il utente is irreversible.',
        ],
        'success' => [
            'blocked' => 'Utente :name has been blocked. They no longer have access to il system.',
            'create' => 'A new utente has been aggiunto to il system con successo.',
            'delete' => 'L’utente :name è stato rimosso dal sistema.',
            'edit' => 'Utente :name has been modificato con successo.',
            'unblocked' => 'Utente :name has been unblocked. They can log in to il system again.',
        ],
        'warning' => [
            'user_is_root' => 'Warning, this utente has Root privileges.',
        ],
    ],
    'warning' => [
        'operation' => 'Attenzione!',
    ],
    'teams' => [
        'info' => [
            'delete' => 'Deleting the team is irreversible.',
        ],
    ],
];
