<?php

namespace App\Support\DataTables;

use Exception;
use Illuminate\Http\Request;

class DataTableController
{
    public function toExcel(Request $request, $class)
    {
        $dataTable = new $class($request);

        if ($dataTable && $dataTable instanceof CustomDataTable && method_exists($dataTable, 'excel')) {
            return $dataTable->excel();
        }

        throw new Exception("DataTable class: [{$class}] not found");
    }

    public function toCsv(Request $request, $class)
    {
        $dataTable = new $class($request);

        if ($dataTable && $dataTable instanceof CustomDataTable && method_exists($dataTable, 'excel')) {
            return $dataTable->csv();
        }

        throw new Exception("DataTable class: [{$class}] not found");
    }
}
