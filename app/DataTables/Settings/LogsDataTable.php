<?php

namespace App\DataTables\Settings;

use App\Models\Vendor\ActivityModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class LogsDataTable extends BaseLogDataTable
{
    protected $id = 'logs_table';

    protected $orderBy = 'created_at';

    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->addColumn('causer', function ($data) {
                return $this->userView($data, 'causer');
            })
            ->addColumn('event', function ($data) {
                return view('components.datatables.badge', [
                    'color' => $this->getEventColor($data->event),
                    'text' => __('logging.events.'.$data->event),
                ]);
            })
            ->addColumn('subject', function ($data) {
                if ($data->subject) {
                    $logEntities = $data->subject->logEntities ?? null;
                    $properties = $data->properties ? $data->properties->first() : null;
                    if ($logEntities) {
                        $instances = [];
                        foreach ($logEntities as $key => $entity) {
                            if (isset($properties[$key])) {
                                if (class_exists($entity)) {
                                    $instance = $entity::find($properties[$key]);
                                    if ($instance) {
                                        $instances[] = $instance;
                                    }
                                }
                            }
                        }

                        if (! empty($instances)) {
                            // return view('components.datatables.link_multiple', [
                            //     'instances' => $instances,
                            // ]);
                        }
                    } else {
                        return $this->subjectView($data);
                    }
                } else {
                    return __('globals.not_applicable');
                }
            })
            ->addColumn('subject_type', function ($data) {
                return $this->subjectTypeView($data);
            })
            ->orderColumn('causer', function ($query, $order) {
                $query->orderBy('firstname', $order);
                $query->orderBy('lastname', $order);
            })
            ->filterColumn('causer', function ($query, $keyword) {
                $sql = "CONCAT(firstname,'-',lastname)  like ?";
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
            ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->select('activity_log.*', 'user_profiles.firstname', 'user_profiles.lastname')
            ->logger();
    }

    protected function defaultColumns(): array
    {
        return [
            'causer',
            'event',
            'subject',
            'subject_type',
            'created_at',
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'causer' => Column::computed('causer')
                ->title(__('logging.columns.causer'))
                ->orderable(true)
                ->searchable(true)
                ->addClass('firstcol'),
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
        return 'Logs_'.date('YmdHis');
    }

    private function getEventColor(string $event): string
    {
        $color = 'primary';

        if ($event === 'auth_attempt_fail') {
            $color = 'danger';
        }

        return $color;
    }
}
