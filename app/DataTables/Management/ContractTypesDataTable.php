<?php

namespace App\DataTables\Management;

use App\Models\Business\TypeOfContract;
use App\Support\DataTables\Column;
use App\Support\DataTables\DataTableBuilder;
use App\Support\DataTables\Services\DataTableService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class ContractTypesDataTable extends DataTableService
{
    protected $id = 'contract_types_table';

    protected $orderBy = 'name';

    protected $orderByDir = 'asc';

    public function DataTable(QueryBuilder $query): DataTableBuilder
    {
        return (new DataTableBuilder($query))
            ->addColumn('action', fn (TypeOfContract $contract) => view('pages.settings.organization.contracts.action', [
                'data' => $contract,
            ]))
            ->editColumn('created_at', fn (TypeOfContract $contract): string => Carbon::parse($contract->created_at)->format(config('app.datetime_format')))
            ->editColumn('updated_at', fn (TypeOfContract $contract): string => Carbon::parse($contract->updated_at)->format(config('app.datetime_format')));
    }

    public function query(TypeOfContract $model): QueryBuilder
    {
        return $model->newQuery();
    }

    protected function defaultColumns(): array
    {
        return [
            'name',
            'created_at',
            'updated_at',
            'action',
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'name' => Column::make('name')
                ->title(__('forms.contracts.name'))
                ->searchable(true)
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
        return 'ContractTypes_' . date('YmdHis');
    }
}
