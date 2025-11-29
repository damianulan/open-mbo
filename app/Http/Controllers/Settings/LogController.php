<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Settings\LogsDataTable;
use App\DataTables\Settings\MyLogsDataTable;

class LogController extends SettingsController
{
    public function index(LogsDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.logs', array(
            'table' => $dataTable,
            'nav' => $this->nav(),
        ));
    }

    public function myLogs(MyLogsDataTable $dataTable)
    {
        return $dataTable->render('pages.settings.my_logs', array(
            'table' => $dataTable,
        ));
    }
}
