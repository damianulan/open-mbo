<?php

namespace App\Facades\DataTable;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\SearchPane;

class CustomDataTable extends DataTable
{

    /**
     * Get the dataTable columns definition.
     */
    final public function getColumns(): array
    {
        return [
            Column::computed('causer')
            ->title(__('logging.columns.causer'))
            ->orderable(true)
            ->searchable(true)
            ->addClass('firstcol'),
            Column::computed('event')
            ->title(__('logging.columns.event')),
            Column::computed('subject')
            ->title(__('logging.columns.subject')),
            Column::computed('subject_type')
            ->title(__('logging.columns.subject_type')),
            Column::make('description')
            ->title(__('logging.columns.description')),
            Column::make('created_at')
            ->title(__('logging.columns.created_at'))
            ->addClass('lastcol'),
        ];
    }


    protected function defaultColumns(): array
    {
        return [];
    }

    protected function availableColumns(): array
    {
        return [];
    }
}
