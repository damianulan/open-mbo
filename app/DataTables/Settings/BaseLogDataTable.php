<?php

namespace App\DataTables\Settings;

use App\Exceptions\Core\DataTablesException;
use App\Support\DataTables\CustomDataTable;
use Illuminate\Support\Facades\Route;

class BaseLogDataTable extends CustomDataTable
{
    public function subjectView($data)
    {
        if ($data->subject) {
            $routeName = __('logging.route_mapping.' . $data->subject_type);
            if (Route::has($routeName)) {
                return view('components.datatables.link', [
                    'route' => route($routeName, $data->subject_id),
                    'text' => $data->subject->name ?? null,
                ]);
            }
            report(new DataTablesException('Route not found: ' . $routeName));

        }

        return __('globals.not_applicable');
    }

    public function subjectTypeView($data)
    {
        if ($data->subject) {
            return __('logging.model_mapping.' . $data->subject_type);
        }

        return __('globals.not_applicable');
    }
}
