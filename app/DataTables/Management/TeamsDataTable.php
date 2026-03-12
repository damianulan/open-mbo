<?php

namespace App\DataTables\Management;

use App\Models\Business\Team;
use App\Support\DataTables\Column;
use App\Support\DataTables\DataTableBuilder;
use App\Support\DataTables\Services\DataTableService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class TeamsDataTable extends DataTableService
{
    protected $id = 'teams_table';

    protected $orderBy = 'created_at';

    protected $orderByDir = 'desc';

    public function DataTable(QueryBuilder $query): DataTableBuilder
    {
        return (new DataTableBuilder($query))
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

    protected function defaultColumns(): array
    {
        return [
            'name',
            'leaders',
            'users_count',
            'created_at',
            'action',
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'name' => Column::make('name')
                ->title(__('forms.teams.name')),
            'leaders' => Column::computed('leaders')
                ->title(__('forms.teams.leaders')),
            'users_count' => Column::computed('users_count')
                ->title(__('forms.teams.users_count')),
            'created_at' => Column::make('created_at')
                ->title(__('fields.created_at')),
            'updated_at' => Column::make('updated_at')
                ->title(__('fields.updated_at')),
            'action' => Column::computed('action')
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
