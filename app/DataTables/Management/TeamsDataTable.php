<?php

namespace App\DataTables\Management;

use App\Models\Business\Team;
use App\Support\DataTables\Column;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class TeamsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('leaders', function (Team $team): string {
                $leaders = $team->leaders->pluck('name')->implode(', ');

                return $leaders ?: '-';
            })
            ->addColumn('users_count', fn (Team $team): int => (int) $team->users_count)
            ->addColumn('action', fn (Team $team) => view('pages.settings.organization.team.action', [
                'data' => $team,
            ]))
            ->editColumn('created_at', fn (Team $team): string => Carbon::parse($team->created_at)->format(config('app.datetime_format')))
            ->editColumn('updated_at', fn (Team $team): string => Carbon::parse($team->updated_at)->format(config('app.datetime_format')));
    }

    public function query(Team $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('leaders')
            ->withCount('users');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->parameters([
                'language' => [
                    'url' => asset('themes/vendors/datatables/pl.json'),
                ],
                'responsive' => true,
                'buttons' => [
                    'csv',
                ],
                'lengthMenu' => [
                    20,
                    50,
                    100,
                    200,
                ],
            ])
            ->setTableId('teams-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->orderBy(0);
    }

    public function getColumns(): array
    {
        return [
            Column::make('name')
                ->title(__('forms.teams.name')),
            Column::computed('leaders')
                ->title(__('forms.teams.leaders')),
            Column::computed('users_count')
                ->title(__('forms.teams.users_count')),
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

    protected function filename(): string
    {
        return 'Teams_' . date('YmdHis');
    }
}
