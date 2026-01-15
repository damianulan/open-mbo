<?php

namespace App\DataTables\Users;

use App\Models\Core\User;
use App\Support\DataTables\CustomDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use App\Support\DataTables\Column;

class UsersDataTable extends CustomDataTable
{
    protected $id = 'users_table';

    protected $orderBy = 'created_at';

    protected array $actions = array('csv', 'excel', 'json', 'column_selector', 'print');

    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('fullname', fn ($data) => $data->name)
            ->addColumn('name', fn ($data) => view('components.datatables.username_link', array(
                'data' => $data,
            )))
            ->addColumn('status', function ($data) {
                $color = 'primary';
                $text = 'Aktywny';
                if ( $data->suspended_at === null) {
                    $color = 'dark';
                    $text = 'Zablokowany';
                }

                return view('components.datatables.badge', array(
                    'color' => $color,
                    'text' => $text,
                ));
            })
            ->orderColumn('status', function ($query, $order): void {
                $o = 'asc' === $order ? 'desc' : 'asc';
                $query->orderBy('suspended_at', $o);
                $query->orderBy('suspended_at', $o);
            })
            ->orderColumn('name', function ($query, $order): void {
                $query->orderBy('firstname', $order);
                $query->orderBy('lastname', $order);
            })
            ->addColumn('roles', fn ($data) => $data->getRolesNames()->implode(', '))
            ->addColumn('action', fn ($data) => view('pages.users.action', array(
                'data' => $data,
            )))
            ->filterColumn('name', function ($query, $keyword): void {
                $sql = "CONCAT(firstname,' ',lastname)  like ?";
                $query->whereRaw($sql, array("%{$keyword}%"));
            })
            ->filterColumn('position', function ($query, $keyword): void {
                $sql = 'positions.name like ?';
                $query->whereRaw($sql, array("%{$keyword}%"));
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
            ->leftJoin('user_employments', 'user_employments.user_id', '=', 'users.id')
            ->leftJoin('companies', 'companies.id', '=', 'user_employments.company_id')
            ->leftJoin('departments', 'departments.id', '=', 'user_employments.department_id')
            ->leftJoin('positions', 'positions.id', '=', 'user_employments.position_id')
            ->select('users.*', 'user_profiles.firstname', 'user_profiles.lastname', 'positions.name as position')
            ->whereNotIn('users.id', array(Auth::user()->id));

        return $query;
    }

    protected function defaultColumns(): array
    {
        return array(
            'name',
            'email',
            'status',
            'created_at',
            'updated_at',
            'position',
            'roles',
            'action',
        );
    }

    protected function availableColumns(): array
    {
        return array(
            'name' => Column::computed('name')
                ->title(__('fields.firstname_lastname'))
                ->searchable(true)
                ->orderable(true)
                ->exportable(false)
                ->printable(false),
            'email' => Column::make('email')
                ->title(__('fields.email')),
            'status' => Column::computed('status')
                ->title(__('fields.status'))
                ->orderable(true),
            'created_at' => Column::make('created_at')
                ->title(__('fields.created_at')),
            'updated_at' => Column::make('updated_at')
                ->title(__('fields.updated_at')),
            'position' => Column::make('position')
                ->title(__('fields.position')),
            'roles' => Column::computed('roles')
                ->title(__('gates.roles_plural'))
                ->searchable(true),
            'action' => Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('action-btns')
                ->title(__('fields.action')),
        );
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
