<?php

namespace App\DataTables\Elearning;

use App\Models\Elearning\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;

class CoursesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($data){
                return view('pages.components.course.list-action', [
                    'data' => $data
                ]);
            })
            ->editColumn('category_id', function($model) {
                return $model->category->title;
            })
            ->editColumn('available_from', function($data){
                if($data->available_from){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->available_from)->format('d-m-Y H:i');
                    return $formatedDate;
                }
                return __('vocabulary.no_data');
            })
            ->editColumn('available_to', function($data){
                if($data->available_to){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->available_to)->format('d-m-Y H:i');
                    return $formatedDate;
                }
                return __('vocabulary.no_data');
            })
            ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i'); return $formatedDate; })
            ->editColumn('updated_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->format('d-m-Y H:i'); return $formatedDate; });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Course $model): QueryBuilder
    {
        return $model->newQuery();
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
                    ])
                    ->setTableId('course-list')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->processing(true)
                    //->dom('Bfrtip')
                    ->orderBy(0);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('title')
            ->title(__('fields.name')),
            Column::make('category_id')
            ->title(__('fields.category')),
            Column::make('available_from')
            ->title(__('fields.courses.available_from')),
            Column::make('available_to')
            ->title(__('fields.courses.available_to')),
            Column::make('created_at')
            ->title(__('fields.created_at')),
            Column::make('updated_at')
            ->title(__('fields.updated_at')),
            Column::computed('action')
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
        return 'Courses_' . date('YmdHis');
    }
}
