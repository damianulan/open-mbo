<?php

namespace App\DataTables\Settings;

use App\Models\Core\User;
use App\Models\Vendor\ActivityModel;
use App\Support\DataTables\Column;
use App\Support\DataTables\DataTableBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class LogsDataTable extends BaseLogDataTable
{
    protected $id = 'logs_table';

    protected $orderBy = 'created_at';

    /**
     * @param QueryBuilder $query Results from query() method.
     */
    public function DataTable(QueryBuilder $query): DataTableBuilder
    {
        return (new DataTableBuilder($query))
            ->addColumn('causer', fn ($data) => $this->userView($data, 'causer'))
            ->addColumn('event', fn ($data) => view('components.datatables.badge', [
                'color' => $this->getEventColor($data->event),
                'text' => __('logging.events.' . $data->event),
            ]))
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
                    } else {
                        return $this->subjectView($data);
                    }
                } else {
                    return __('globals.not_applicable');
                }
            })
            ->addColumn('subject_type', fn ($data) => $this->subjectTypeView($data))
            ->orderColumn('causer', function ($query, $order): void {
                $query->orderBy(
                    User::query()->select('firstname')
                        ->whereColumn('users.id', 'activity_log.causer_id')
                        ->limit(1),
                    $order,
                );
                $query->orderBy(
                    User::query()->select('lastname')
                        ->whereColumn('users.id', 'activity_log.causer_id')
                        ->limit(1),
                    $order,
                );
            })
            ->filterColumn('causer', function ($query, $keyword): void {
                $query->whereHasMorph('causer', [User::class], function (QueryBuilder $query) use ($keyword): void {
                    $query->whereRaw("CONCAT(firstname,'-',lastname) like ?", ["%{$keyword}%"]);
                });
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::parse($data->created_at)->format(config('app.datetime_format'));

                return $formatedDate;
            });
    }

    public function query(ActivityModel $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['causer', 'subject'])
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
                ->searchable(true),
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

    protected function filename(): string
    {
        return 'Logs_' . date('YmdHis');
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
