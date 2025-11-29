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

        throw new Exception("DataTable class: [{$class}] excel() method not found");
    }

    public function toCsv(Request $request, $class)
    {
        $dataTable = new $class($request);

        if ($dataTable && $dataTable instanceof CustomDataTable && method_exists($dataTable, 'csv')) {
            return $dataTable->csv();
        }

        throw new Exception("DataTable class: [{$class}] csv() method not found");
    }

    public function toPdf(Request $request, $class)
    {
        $dataTable = new $class($request);

        if ($dataTable && $dataTable instanceof CustomDataTable && method_exists($dataTable, 'snappyPdf')) {
            return $dataTable->snappyPdf();
        }

        throw new Exception("DataTable class: [{$class}] pdf() method not found");
    }

    public function toJson(Request $request, $class)
    {
        $dataTable = new $class($request);

        if ($dataTable && $dataTable instanceof CustomDataTable && method_exists($dataTable, 'json')) {
            return $dataTable->json();
        }

        throw new Exception("DataTable class: [{$class}] json() method not found");
    }
}
