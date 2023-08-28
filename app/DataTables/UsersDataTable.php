<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\SearchPane;
use Illuminate\Support\Carbon;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function($data) {
                return view('components.datatables.username', [
                    'data' => $data,
                ]);
            })
            ->orderColumn('name', function($query, $order) {
                $query->orderBy('firstname', $order);
                $query->orderBy('lastname', $order);
            })
            ->addColumn('action', function($data) {
                return view('pages.users.action', [
                    'data' => $data,
                ]);
            })
            ->filterColumn('name', function($query, $keyword){
                $sql = "CONCAT(users.firstname,'-',users.lastname)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format(config('app.datetime_format')); return $formatedDate; })
            ->editColumn('updated_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format(config('app.datetime_format')); return $formatedDate; });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->whereNotIn('id', [auth()->user()->id]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
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
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->processing(true)
                    ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('name')
            ->title(__('fields.firstname_lastname'))
            ->sortable(true)
            ->addClass('firstcol'),
            Column::make('created_at')
            ->title(__('fields.created_at')),
            Column::make('updated_at')
            ->title(__('fields.updated_at')),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->addClass('lastcol action-btns')
            ->title(__('fields.action')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
