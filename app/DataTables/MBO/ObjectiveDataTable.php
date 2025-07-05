<?php

namespace App\DataTables\MBO;

use App\Models\MBO\Objective;
use App\Support\DataTables\CustomDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ObjectiveDataTable extends CustomDataTable
{
    protected $id = 'objective_table';

    protected $orderBy = 'deadline';

    protected $orderByDir = 'desc';

    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', function ($data) {
                return view('pages.mbo.objectives.action', [
                    'data' => $data,
                ]);
            })
            ->editColumn('deadline', function ($data) {
                $formatedDate = Carbon::parse($data->deadline)->format(config('app.date_format'));

                return $formatedDate;
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::parse($data->created_at)->format(config('app.datetime_format'));

                return $formatedDate;
            })
            ->editColumn('updated_at', function ($data) {
                $formatedDate = Carbon::parse($data->created_at)->format(config('app.datetime_format'));

                return $formatedDate;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Objective $model): QueryBuilder
    {
        $query = $model->query();

        return $query;
    }

    protected function defaultColumns(): array
    {
        return [
            'name',
            'deadline',
            'weight',
            'award',
            'expected',
            'created_at',
            'updated_at',
            'action',
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'name' => Column::make('name')
                ->title(__('forms.mbo.objectives.name'))
                ->searchable(true)
                ->orderable(true)
                ->addClass('firstcol'),
            'deadline' => Column::make('deadline')
                ->title(__('forms.mbo.objectives.deadline'))
                ->orderable(true),
            'weight' => Column::make('weight')
                ->title(__('forms.mbo.objectives.weight'))
                ->orderable(true),
            'award' => Column::make('award')
                ->title(__('forms.mbo.objectives.award'))
                ->orderable(true),
            'expected' => Column::make('expected')
                ->title(__('forms.mbo.objectives.expected'))
                ->orderable(true),
            'created_at' => Column::make('created_at')
                ->title(__('fields.created_at')),
            'updated_at' => Column::make('updated_at')
                ->title(__('fields.updated_at')),
            'action' => Column::computed('action')
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
        return 'Objectives_'.date('YmdHis');
    }
}
