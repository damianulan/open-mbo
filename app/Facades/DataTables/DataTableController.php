<?php

namespace App\Facades\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use App\Facades\DataTables\CustomDataTable;

class DataTableController
{
    public function toExcel(Request $request, $class)
    {
        $dataTable = new $class($request);

        if ($dataTable && $dataTable instanceof CustomDataTable && method_exists($dataTable, 'excel')) {
            return $dataTable->excel();
        }

        throw new \Exception("DataTable class: [$class] not found");
    }

    public function toCsv(Request $request, $class)
    {
        $dataTable = new $class($request);

        if ($dataTable && $dataTable instanceof CustomDataTable && method_exists($dataTable, 'excel')) {
            return $dataTable->csv();
        }

        throw new \Exception("DataTable class: [$class] not found");
    }
}
