<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Settings\LogsDataTable;
use App\DataTables\Settings\MyLogsDataTable;

class LogController extends SettingsController
{
    public function index(LogsDataTable $dataTable)
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.logs', [
            'table' => $dataTable,
        ]);
    }

    public function myLogs(MyLogsDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.my_logs', [
            'table' => $dataTable,
        ]);
    }
}
