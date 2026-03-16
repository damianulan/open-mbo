<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Settings\LogsDataTable;

class LogController extends SettingsController
{
    public function index(LogsDataTable $dataTable)
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.logs', [
            'table' => $dataTable,
        ]);
    }
}
