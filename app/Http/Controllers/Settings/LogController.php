<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Settings\LogsDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;

class LogController extends SettingsController
{
    public function index(LogsDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.logs', [
            'table' => $dataTable,
        ]);
    }
}
