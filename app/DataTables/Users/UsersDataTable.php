<?php

namespace App\DataTables\Users;

use App\Enums\Users\UserStatus;
use App\Filters\Collections\UsersTableFilters;
use App\Models\Business\Position;
use App\Models\Business\UserEmployment;
use App\Models\Core\User;
use App\Support\DataTables\Column;
use App\Support\DataTables\DataTableBuilder;
use App\Support\DataTables\Services\DataTableService;
use App\Support\Filters\Contracts\FilterCollection;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UsersDataTable extends DataTableService
{
    protected $id = 'users_table';

    protected $orderBy = 'created_at';

    protected array $actions = ['csv', 'excel', 'json', 'column_selector', 'print'];

    /**
     * @param QueryBuilder $query Results from query() method.
     */
    public function DataTable(QueryBuilder $query): DataTableBuilder
    {
        return (new DataTableBuilder($query))
            ->addColumn('fullname', fn ($data) => $data->name)
            ->addColumn('name', fn ($data) => view('components.datatables.username_link', [
                'data' => $data,
            ]))
            ->addColumn('status', function ($data) {
                /** @var UserStatus $status */
                $status = $data->statusEnum();
                $text = $status->label();
                $color = $status->color();

                return view('components.datatables.badge', [
                    'color' => $color,
                    'text' => $text,
                ]);
            })
            ->orderColumn('status', function ($query, $order): void {
                $o = $order === 'asc' ? 'desc' : 'asc';
                $query->orderBy('suspended_at', $o);
                $query->orderBy('suspended_at', $o);
            })
            ->orderColumn('name', function ($query, $order): void {
                $query->orderBy('firstname', $order);
                $query->orderBy('lastname', $order);
            })
            ->orderColumn('position', function ($query, $order): void {
                $query->orderBy($this->positionNameSubquery(), $order);
            })
            ->addColumn('roles', fn ($data) => $data->getRolesNames()->implode(', '))
            ->addColumn('action', fn ($data) => view('pages.users.action', [
                'data' => $data,
            ]))
            ->filterColumn('name', function ($query, $keyword): void {
                $sql = "CONCAT(firstname,' ',lastname)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('position', function ($query, $keyword): void {
                $query->whereHas('employment.position', function (QueryBuilder $query) use ($keyword): void {
                    $query->where('name', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::parse($data->created_at)->format(config('app.datetime_format'));

                return $formatedDate;
            })
            ->editColumn('updated_at', function ($data) {
                $formatedDate = Carbon::parse($data->created_at)->format(config('app.datetime_format'));

                return $formatedDate;
            })
            ->registerFilters($this->getFilterService());
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['employment.position'])
            ->addSelect([
                'position' => $this->positionNameSubquery(),
            ])
            ->whereNotIn('users.id', [Auth::user()->id]);
    }

    protected function buildFilters(): ?FilterCollection
    {
        return app()->make(UsersTableFilters::class);
    }

    protected function defaultColumns(): array
    {
        return [
            'name',
            'email',
            'status',
            'created_at',
            'updated_at',
            'position',
            'roles',
            'action',
        ];
    }

    protected function availableColumns(): array
    {
        return [
            'name' => Column::computed('name')
                ->title(__('fields.firstname_lastname'))
                ->searchable(true)
                ->orderable(true)
                ->exportable(false)
                ->printable(false),
            'email' => Column::make('email')
                ->title(__('fields.email')),
            'status' => Column::make('status')
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
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }

    private function positionNameSubquery(): QueryBuilder
    {
        return Position::query()
            ->select('name')
            ->where('positions.id', '=', UserEmployment::query()
                ->select('position_id')
                ->whereColumn('user_employments.user_id', 'users.id')
                ->active()
                ->limit(1))
            ->limit(1);
    }
}
