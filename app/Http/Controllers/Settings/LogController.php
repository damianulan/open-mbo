<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Settings\LogsDataTable;
use App\DataTables\Settings\MyLogsDataTable;

class LogController extends Controller
{
    public function index(LogsDataTable $dataTable)
    {
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
