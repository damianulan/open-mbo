<?php

namespace App\DataTables\Management;

use App\Models\Business\Company;
use App\Support\DataTables\Column;
use App\Support\DataTables\DataTableBuilder;
use App\Support\DataTables\Services\DataTableService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class CompaniesDataTable extends DataTableService
{
    protected $id = 'companies_table';

    protected $orderBy = 'name';

    protected $orderByDir = 'asc';

    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function DataTable(QueryBuilder $query): DataTableBuilder
    {
        return (new DataTableBuilder($query))
            ->addColumn('action', fn (Company $company) => view('pages.settings.organization.company.action', [
                'data' => $company,
            ]))
            ->editColumn('shortname', fn (Company $company): string => $company->shortname ?: '-')
            ->editColumn('taxpayerid', fn (Company $company): string => $company->taxpayerid ?: '-')
            ->editColumn('founded_at', function (Company $company): string {
                if ( ! $company->founded_at) {
                    return '-';
                }

                return Carbon::parse($company->founded_at)->format(config('app.date_format'));
            })
            ->editColumn('created_at', fn (Company $company): string => Carbon::parse($company->created_at)->format(config('app.datetime_format')))
            ->editColumn('updated_at', fn (Company $company): string => Carbon::parse($company->updated_at)->format(config('app.datetime_format')));
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Company $model): QueryBuilder
    {
        return $model->newQuery();
    }

    protected function defaultColumns(): array
    {
        return [
            'name',
            'shortname',
            'taxpayerid',
            'founded_at',
            'created_at',
            'updated_at',
            'action',
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'name' => Column::make('name')
                ->title(__('forms.companies.name'))
                ->searchable(true)
                ->orderable(true),
            'shortname' => Column::make('shortname')
                ->title(__('forms.companies.shortname'))
                ->searchable(true)
                ->orderable(true),
            'taxpayerid' => Column::make('taxpayerid')
                ->title(__('forms.companies.taxpayerid'))
                ->searchable(true)
                ->orderable(true),
            'founded_at' => Column::make('founded_at')
                ->title(__('forms.companies.founded_at'))
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

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Companies_' . date('YmdHis');
    }
}
