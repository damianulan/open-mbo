<?php

namespace App\DataTables\Management;

use App\Models\Business\Department;
use App\Support\DataTables\Column;
use App\Support\DataTables\DataTableBuilder;
use App\Support\DataTables\Services\DataTableService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class DepartmentsDataTable extends DataTableService
{
    protected $id = 'departments_table';

    protected $orderBy = 'name';

    protected $orderByDir = 'asc';

    public function DataTable(QueryBuilder $query): DataTableBuilder
    {
        return (new DataTableBuilder($query))
            ->addColumn('company', fn (Department $department): string => $department->company?->name ?? '-')
            ->addColumn('action', fn (Department $department) => view('pages.settings.organization.departments.action', [
                'data' => $department,
            ]))
            ->editColumn('created_at', fn (Department $department): string => Carbon::parse($department->created_at)->format(config('app.datetime_format')))
            ->editColumn('updated_at', fn (Department $department): string => Carbon::parse($department->updated_at)->format(config('app.datetime_format')));
    }

    public function query(Department $model): QueryBuilder
    {
        return $model->newQuery()->with('company');
    }

    protected function defaultColumns(): array
    {
        return [
            'company',
            'name',
            'created_at',
            'updated_at',
            'action',
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'company' => Column::computed('company')
                ->title(__('forms.departments.company')),
            'name' => Column::make('name')
                ->title(__('forms.departments.name'))
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
        return 'Departments_' . date('YmdHis');
    }
}
