<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Settings\NotificationsDataTable;
use Illuminate\Contracts\Support\Renderable;

class NotificationsController extends SettingsController
{
    /**
     * Show the application dashboard.
     * @param NotificationsDataTable $dataTable
     */
    public function index(NotificationsDataTable $dataTable): Renderable
    {

        return $dataTable->render('pages.settings.notifications.index', array(
            'table' => $dataTable,
            'nav' => $this->nav(),
        ));
    }
}
