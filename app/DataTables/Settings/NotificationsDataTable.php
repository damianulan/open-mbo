<?php

namespace App\DataTables\Settings;

use App\Models\Vendor\ActivityModel;
use App\Support\Notifications\Models\Notification;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use App\Support\DataTables\CustomDataTable;

class NotificationsDataTable extends CustomDataTable
{
    protected $id = 'notifications_table';

    protected $orderBy = 'created_at';

    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->editColumn('system', function ($data) {
                return $data->system ? __('globals.yes') : __('globals.no');
            })
            ->editColumn('email', function ($data) {
                return $data->email ? __('globals.yes') : __('globals.no');
            })
            ->editColumn('event', function ($data) {
                return $data->event ? __('globals.yes') : __('globals.no');
            })
            ->editColumn('schedule', function ($data) {
                return $data->schedule ? __('globals.yes') : __('globals.no');
            })
            ->editColumn('conditions', function ($data) {
                return $data->conditions ? __('globals.yes') : __('globals.no');
            })
            ->addColumn('status', function ($data) {
                $active = !$data->email && !$data->system ? false : true;
                return view('components.datatables.badge', [
                    'color' => $active ? 'primary' : 'warning',
                    'text' => $active ? __('globals.active') : __('globals.inactive'),
                ]);
            })
            ->addColumn('action', function ($data) {
                return view('pages.settings.notifications.action', [
                    'data' => $data,
                ]);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Notification $model): QueryBuilder
    {
        return $model->query();
    }

    protected function defaultColumns(): array
    {
        return [
            'key',
            'system',
            'email',
            'event',
            'schedule',
            'conditions',
            'status',
            'action'
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'key' => Column::make('key')
                ->title(__('notifications.table.key'))
                ->orderable(true)
                ->searchable(true)
                ->addClass('firstcol'),
            'system' => Column::make('system')
                ->title(__('notifications.table.system')),
            'email' => Column::make('email')
                ->title(__('notifications.table.email')),
            'event' => Column::make('event')
                ->title(__('notifications.table.event')),
            'schedule' => Column::make('schedule')
                ->title(__('notifications.table.schedule')),
            'conditions' => Column::make('conditions')
                ->title(__('notifications.table.conditions')),
            'status' => Column::computed('status')
                ->title(__('notifications.table.status')),
            'action' => Column::computed('action')
                ->title(__('notifications.table.action'))
                ->addClass('lastcol'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Notifications_' . date('YmdHis');
    }
}
