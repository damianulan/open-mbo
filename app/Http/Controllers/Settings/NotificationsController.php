<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Settings\NotificationsDataTable;
use Illuminate\Contracts\Support\Renderable;

class NotificationsController extends SettingsController
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(NotificationsDataTable $dataTable)
    {

        return $dataTable->render('pages.settings.notifications.index', array(
            'table' => $dataTable,
            'nav' => $this->nav(),
        ));
    }
}
