<?php

namespace App\DataTables\Settings;

use App\Models\Core\User;
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
     * @param QueryBuilder $query Results from query() method.
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
            ->logger()
            ->mine();
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

    protected function filename(): string
    {
        return 'MyLogs_' . date('YmdHis');
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
