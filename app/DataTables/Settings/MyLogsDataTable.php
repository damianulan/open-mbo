<?php

namespace App\DataTables\Settings;

use App\Models\Vendor\ActivityModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class MyLogsDataTable extends BaseLogDataTable
{
    protected $id = 'my_logs_table';

    protected $orderBy = 'created_at';

    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->addColumn('event', fn ($data) => view('components.datatables.badge', array(
                'color' => $this->getEventColor($data->event),
                'text' => __('logging.events.' . $data->event),
            )))
            ->addColumn('subject', fn ($data) => $this->subjectView($data))
            ->addColumn('subject_type', fn ($data) => $this->subjectTypeView($data))
            ->orderColumn('causer', function ($query, $order): void {
                $query->orderBy('firstname', $order);
                $query->orderBy('lastname', $order);
            })
            ->filterColumn('causer', function ($query, $keyword): void {
                $sql = "CONCAT(firstname,'-',lastname)  like ?";
                $query->whereRaw($sql, array("%{$keyword}%"));
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
            ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->select('activity_log.*', 'user_profiles.firstname', 'user_profiles.lastname')
            ->logger()->mine();
    }

    protected function defaultColumns(): array
    {
        return array(
            'event',
            'subject',
            'subject_type',
            'created_at',
        );
    }

    protected function availableColumns(): array
    {
        return array(
            'event' => Column::computed('event')
                ->title(__('logging.columns.event'))
                ->addClass('firstcol'),
            'subject' => Column::computed('subject')
                ->title(__('logging.columns.subject')),
            'subject_type' => Column::computed('subject_type')
                ->title(__('logging.columns.subject_type')),
            'description' => Column::make('description')
                ->title(__('logging.columns.description')),
            'created_at' => Column::make('created_at')
                ->title(__('logging.columns.created_at'))
                ->addClass('lastcol'),
        );
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
