<?php

namespace App\DataTables\Settings;

use App\Models\Business\Company;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use App\Facades\DataTables\CustomDataTable;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

class MyLogsDataTable extends CustomDataTable
{
    protected $id = 'my_logs_table';
    protected $orderBy = 'created_at';

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->addColumn('event', function($data) {
                return view('components.datatables.badge', [
                    'color' => $this->getEventColor($data->event),
                    'text' => __('logging.events.'.$data->event),
                ]);
            })
            ->addColumn('subject', function($data) {
                if($data->subject){
                    return view('components.datatables.link', [
                        'route' => route(__('logging.route_mapping.'.$data->subject_type), $data->subject_id),
                        'text' => $data->subject->name,
                    ]);
                } else {
                    return __('vocabulary.not_applicable');
                }

            })
            ->addColumn('subject_type', function($data) {
                if($data->subject){
                    return __('logging.model_mapping.'.$data->subject_type);
                } else {
                    return __('vocabulary.not_applicable');
                }
            })
            ->orderColumn('causer', function($query, $order) {
                $query->orderBy('firstname', $order);
                $query->orderBy('lastname', $order);
            })
            ->filterColumn('causer', function($query, $keyword){
                $sql = "CONCAT(firstname,'-',lastname)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format(config('app.datetime_format')); return $formatedDate; });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Activity $model): QueryBuilder
    {
        return $model->join('users', 'users.id', '=', 'activity_log.causer_id')
                    ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
                    ->select('activity_log.*', 'user_profiles.firstname', 'user_profiles.lastname')
                    ->where('users.id', auth()->user()->id);
    }

    protected function defaultColumns(): array
    {
        return [
            'event', 'subject', 'subject_type', 'created_at'
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'event'         => Column::computed('event')
                                ->title(__('logging.columns.event'))
                                ->addClass('firstcol'),
            'subject'       => Column::computed('subject')
                                ->title(__('logging.columns.subject')),
            'subject_type'  => Column::computed('subject_type')
                                ->title(__('logging.columns.subject_type')),
            'description'   => Column::make('description')
                                ->title(__('logging.columns.description')),
            'created_at'    => Column::make('created_at')
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

        if($event === 'auth_attempt_fail'){
            $color = 'danger';
        }

        return $color;
    }
}
