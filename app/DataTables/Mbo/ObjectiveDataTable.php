<?php

namespace App\DataTables\Mbo;

use App\Contracts\Repositories\ObjectiveRepositoryContract;
use App\Models\Mbo\Objective;
use App\Support\DataTables\Column;
use App\Support\DataTables\DataTableBuilder;
use App\Support\DataTables\Services\DataTableService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class ObjectiveDataTable extends DataTableService
{
    protected $id = 'objective_table';

    protected $orderBy = 'deadline';

    protected $orderByDir = 'desc';

    public function __construct(
        private readonly ObjectiveRepositoryContract $objectiveRepository,
    ) {
        parent::__construct();
    }

    /**
     * @param QueryBuilder $query Results from query() method.
     */
    public function DataTable(QueryBuilder $query): DataTableBuilder
    {
        return (new DataTableBuilder($query))
            ->addColumn('action', fn ($data) => view('pages.mbo.objectives.action', [
                'data' => $data,
            ]))
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

    public function query(Objective $model): QueryBuilder
    {
        $query = $this->objectiveRepository->queryForDataTable();

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
                ->orderable(true),
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
                ->addClass('action-btns')
                ->title(__('fields.action')),
        ];
    }

    protected function filename(): string
    {
        return 'Objectives_' . date('YmdHis');
    }
}
