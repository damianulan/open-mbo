<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\SmtpForm;
use App\Settings\GeneralSettings;
use App\Settings\MailSettings;
use Illuminate\Http\Request;
use App\DataTables\Settings\NotificationsDataTable;

class NotificationsController extends SettingsController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(NotificationsDataTable $dataTable)
    {

        return $dataTable->render('pages.settings.notifications.index', [
            'table' => $dataTable,
            'nav' => $this->nav(),
        ]);
    }
}
