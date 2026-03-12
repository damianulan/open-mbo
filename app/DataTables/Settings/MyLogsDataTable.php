<?php

namespace App\DataTables\Settings;

use App\Models\Vendor\ActivityModel;
use App\Support\DataTables\Column;
use App\Support\DataTables\DataTableBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class MyLogsDataTable extends BaseLogDataTable
{
    protected $id = 'my_logs_table';

    protected $orderBy = 'created_at';

    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function DataTable(QueryBuilder $query): DataTableBuilder
    {

        return (new DataTableBuilder($query))
            ->addColumn('event', fn ($data) => view('components.datatables.badge', [
                'color' => $this->getEventColor($data->event),
                'text' => __('logging.events.' . $data->event),
            ]))
            ->addColumn('subject', fn ($data) => $this->subjectView($data))
            ->addColumn('subject_type', fn ($data) => $this->subjectTypeView($data))
            ->orderColumn('causer', function ($query, $order): void {
                $query->orderBy('users.firstname', $order);
                $query->orderBy('users.lastname', $order);
            })
            ->filterColumn('causer', function ($query, $keyword): void {
                $sql = "CONCAT(users.firstname,'-',users.lastname) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::parse($data->created_at)->format(config('app.datetime_format'));

                return $formatedDate;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ActivityModel $model): QueryBuilder
    {
        return $model->join('users', 'users.id', '=', 'activity_log.causer_id')
            ->select('activity_log.*', 'users.firstname', 'users.lastname')
            ->logger()->mine();
    }

    protected function defaultColumns(): array
    {
        return [
            'event',
            'subject',
            'subject_type',
            'created_at',
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'event' => Column::computed('event')
                ->title(__('logging.columns.event')),
            'subject' => Column::computed('subject')
                ->title(__('logging.columns.subject')),
            'subject_type' => Column::computed('subject_type')
                ->title(__('logging.columns.subject_type')),
            'description' => Column::make('description')
                ->title(__('logging.columns.description')),
            'created_at' => Column::make('created_at')
                ->title(__('logging.columns.created_at'))
                ->addClass('lastcol'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'MyLogs_' . date('YmdHis');
    }

    private function getEventColor(string $event): string
    {
        $color = 'primary';

        if ('auth_attempt_fail' === $event) {
            $color = 'danger';
        }

        return $color;
    }
}
