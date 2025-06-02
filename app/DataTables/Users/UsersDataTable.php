<?php

namespace App\DataTables\Users;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Carbon;
use App\Support\DataTables\CustomDataTable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UsersDataTable extends CustomDataTable
{
    protected $id = 'users_table';
    protected $orderBy = 'created_at';

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function ($data) {
                return view('components.datatables.username_link', [
                    'data' => $data,
                ]);
            })
            ->addColumn('status', function ($data) {
                $color = 'primary';
                $text = 'Aktywny';
                if (!$data->active) {
                    $color = 'dark';
                    $text = 'Zablokowany';
                }
                return view('components.datatables.badge', [
                    'color' => $color,
                    'text' => $text,
                ]);
            })
            ->orderColumn('status', function ($query, $order) {
                $o = $order === 'asc' ? 'desc' : 'asc';
                $query->orderBy('active', $o);
                $query->orderBy('active', $o);
            })
            ->orderColumn('name', function ($query, $order) {
                $query->orderBy('firstname', $order);
                $query->orderBy('lastname', $order);
            })
            ->addColumn('roles', function ($data) {
                return $data->getRolesNames()->implode(', ');
            })
            ->addColumn('action', function ($data) {
                return view('pages.users.action', [
                    'data' => $data,
                ]);
            })
            ->filterColumn('name', function ($query, $keyword) {
                $sql = "CONCAT(firstname,' ',lastname)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::parse($data->created_at)->format(config('app.datetime_format'));
                return $formatedDate;
            })
            ->editColumn('updated_at', function ($data) {
                $formatedDate = Carbon::parse($data->created_at)->format(config('app.datetime_format'));
                return $formatedDate;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $query = $model->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->select('users.*', 'user_profiles.firstname', 'user_profiles.lastname')
            ->whereNotIn('users.id', [Auth::user()->id]);
        return $query;
    }

    protected function defaultColumns(): array
    {
        return [
            'name',
            'email',
            'status',
            'created_at',
            'updated_at',
            'roles',
            'action'
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'name'          => Column::computed('name')
                ->title(__('fields.firstname_lastname'))
                ->searchable(true)
                ->orderable(true)
                ->addClass('firstcol'),
            'email'         => Column::make('email')
                ->title(__('fields.email')),
            'status'        => Column::computed('status')
                ->title(__('fields.status'))
                ->orderable(true),
            'created_at'    => Column::make('created_at')
                ->title(__('fields.created_at')),
            'updated_at'    => Column::make('updated_at')
                ->title(__('fields.updated_at')),
            'roles'          => Column::computed('roles')
                ->title(__('gates.roles_plural'))
                ->searchable(true),
            'action'    => Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('lastcol action-btns')
                ->title(__('fields.action')),
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
