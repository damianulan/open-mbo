<?php

namespace App\Facades\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\SearchPane;
use App\Facades\DataTables\SelectedColumns;
use Illuminate\Support\Facades\Validator;

class CustomDataTable extends DataTable
{

    protected $id = null;
    protected $orderBy = null;
    protected $orderByDir = 'desc';

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $columns = $this->selectedColumns();
        $available = $this->availableColumns();

        $output = array_filter($available, function($key) use($columns) {
            return in_array($key, $columns);
        }, ARRAY_FILTER_USE_KEY);
        return $output;
    }

    public function columnSelector()
    {
        $view = view('components.datatables.partials.columns', [
            'datatable_id' => $this->id,
            'columns' => $this->availableColumns(),
            'selected' => $this->selectedColumns(),
        ]);

        return $view;
    }

    protected function selectedColumns(): array
    {
        $columns = array();
        $model = SelectedColumns::findColumn($this->id);
        $columns_raw = $model->columns ?? array();
        $available = $this->availableColumns();

        if(empty($columns_raw)){
            $columns = $this->defaultColumns();
        } else {
            $columns = array_filter($columns_raw, function ($c) use($available) {
                return array_key_exists($c, $available);
            });
        }

        return $columns;
    }

    protected function defaultColumns(): array
    {
        return [];
    }

    protected function availableColumns(): array
    {
        return [];
    }

    protected function getOrderBy(): ?int
    {
        $orderBy = null;
        if($this->orderBy){
            $columns = array_keys($this->getColumns());
            if(!empty($columns)){
                foreach($columns as $key => $column){
                    if($column === $this->orderBy){
                        $orderBy = $key;
                        break;
                    }
                }
            }
        }

        return $orderBy;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $builder = $this->builder()
                    ->parameters([
                        'language' => [
                            'url' => asset('themes/vendors/datatables/pl.json'),
                        ],
                        'responsive' => true,
                        'buttons' => [
                            'csv'
                        ],
                        'lengthMenu' => [
                            20, 50, 100, 200
                        ],
                    ])
                    ->setTableId($this->id)
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->processing(true);

        $orderBy = $this->getOrderBy();
        if(!is_null($orderBy)){
            $builder->orderBy($orderBy, $this->orderByDir);
        }
        return $builder;
    }

    public function saveColumns(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'datatable_id' => 'required|string',
            'columns' => 'present|array',
        ]);

        if($validator->passes()){
            $datatable_id = $request->input('datatable_id');
            $columns = $request->input('columns');

            $selected = SelectedColumns::findColumn($datatable_id) ?? new SelectedColumns();
            $selected->user_id = auth()->user()->id;
            $selected->table_id = $datatable_id;
            $selected->columns = $columns;

            if($selected->save()){
                return redirect()->back();
            } else {
                return redirect()->back()->with('error', __('alerts.datatables.save_columns.error'));
            }
        }

        return redirect()->back()->with('error', __('alerts.datatables.save_columns.error_data'));

    }

}
