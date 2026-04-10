<?php

namespace App\DataTables\Mbo;

use App\Models\Mbo\ObjectiveTemplateCategory;
use App\Support\DataTables\Column;
use App\Support\DataTables\DataTableBuilder;
use App\Support\DataTables\Services\DataTableService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class ObjectiveCategoriesDataTable extends DataTableService
{
    protected $id = 'objective_template_categories_table';

    protected $orderBy = 'name';

    protected $orderByDir = 'asc';

    /**
     * @param QueryBuilder $query Results from query() method.
     */
    public function DataTable(QueryBuilder $query): DataTableBuilder
    {
        return (new DataTableBuilder($query))
            ->addColumn('action', fn ($data) => view('pages.mbo.categories.action', [
                'data' => $data,
            ]))
            ->addColumn('templates', fn ($data) => $data->objective_templates()->count())
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::parse($data->created_at)->format(config('app.datetime_format'));

                return $formatedDate;
            })
            ->editColumn('updated_at', function ($data) {
                $formatedDate = Carbon::parse($data->created_at)->format(config('app.datetime_format'));

                return $formatedDate;
            });
    }

    public function query(ObjectiveTemplateCategory $model): QueryBuilder
    {
        $query = $model->query();

        return $query;
    }

    protected function defaultColumns(): array
    {
        return [
            'name',
            'shortname',
            'templates',
            'created_at',
            'updated_at',
            'action',
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'name' => Column::make('name')
                ->title(__('forms.mbo.categories.name'))
                ->searchable(true)
                ->orderable(true),
            'shortname' => Column::computed('shortname')
                ->title(__('forms.mbo.categories.shortname'))
                ->searchable(true)
                ->orderable(true),
            'templates' => Column::computed('templates')
                ->title(__('forms.mbo.categories.template_count')),
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
        return 'ObjectiveTemplateCategories_' . date('YmdHis');
    }
}
