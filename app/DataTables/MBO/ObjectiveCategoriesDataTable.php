<?php

namespace App\DataTables\MBO;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Carbon;
use App\Support\DataTables\CustomDataTable;
use App\Models\MBO\Objective;
use Illuminate\Support\Collection;
use App\Models\MBO\ObjectiveTemplateCategory;
use DB;

class ObjectiveCategoriesDataTable extends CustomDataTable
{
    protected $id = 'objective_template_categories_table';
    protected $orderBy = 'name';
    protected $orderByDir = 'asc';

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', function ($data) {
                return view('pages.mbo.categories.action', [
                    'data' => $data,
                ]);
            })
            ->addColumn('templates', function ($data) {
                return $data->objective_templates()->count();
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
            'action'
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'name'          => Column::make('name')
                ->title(__('forms.mbo.categories.name'))
                ->searchable(true)
                ->orderable(true)
                ->addClass('firstcol'),
            'shortname'          => Column::computed('shortname')
                ->title(__('forms.mbo.categories.shortname'))
                ->searchable(true)
                ->orderable(true),
            'templates'     => Column::computed('templates')
                ->title(__('forms.mbo.categories.template_count')),
            'created_at'    => Column::make('created_at')
                ->title(__('fields.created_at')),
            'updated_at'    => Column::make('updated_at')
                ->title(__('fields.updated_at')),
            'action'        => Column::computed('action')
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
        return 'ObjectiveTemplateCategories_' . date('YmdHis');
    }
}
