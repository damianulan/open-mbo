<?php

namespace App\Support\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\File;

class CustomDataTable extends DataTable
{
    protected $id = null;

    protected $orderBy = null;

    protected $orderByDir = 'desc';

    protected array $actions = array('csv', 'excel', 'column_selector');

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $columns = $this->selectedColumns();
        $available = $this->availableColumns();

        $output = array_filter($available, fn ($key) => in_array($key, $columns), ARRAY_FILTER_USE_KEY);

        usort($output, function ($x, $y) use ($columns) {
            $pos_x = array_search($x->data, $columns);
            $pos_y = array_search($y->data, $columns);

            return $pos_x - $pos_y;
        });

        return $output;
    }

    public function actions()
    {
        $model = SelectedColumns::findColumn($this->id);
        $available = $this->availableColumns();
        if ($model) {
            $selected = $model->selected;
            uasort($available, function ($x, $y) use ($selected) {
                $pos_x = array_search($x->name, $selected);
                $pos_y = array_search($y->name, $selected);

                return $pos_x - $pos_y;
            });
        }

        $view = view('components.datatables.partials.columns', array(
            'datatable_id' => $this->id,
            'columns' => $available,
            'selected' => $this->selectedColumns(),
            'hasColumns' => in_array('column_selector', $this->actions),
            'hasCsv' => in_array('csv', $this->actions),
            'hasExcel' => in_array('excel', $this->actions),
            'hasJson' => in_array('json', $this->actions),
            'hasPdf' => in_array('pdf', $this->actions),
            'class' => static::class,
        ));

        return $view;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $builder = $this->builder()
            ->parameters(array(
                'language' => array(
                    'url' => asset('themes/vendors/datatables/pl.json'),
                ),
                'responsive' => true,
                'buttons' => array(
                    'csv',
                ),
                'lengthMenu' => array(
                    20,
                    50,
                    100,
                    200,
                ),
            ))
            ->setTableId($this->id)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true);

        $orderBy = $this->getOrderBy();
        if ( ! is_null($orderBy)) {
            $builder->orderBy($orderBy, $this->orderByDir);
        }

        return $builder;
    }

    public function saveColumns(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'datatable_id' => 'required|string',
            'selected' => 'present|array',
        ));

        if ($validator->passes()) {
            $datatable_id = $request->input('datatable_id');
            $columns = $request->input('columns');
            $selected = $request->input('selected');

            $sc = SelectedColumns::findColumn($datatable_id) ?? new SelectedColumns();
            $sc->user_id = Auth::user()->id;
            $sc->table_id = $datatable_id;
            $sc->columns = $columns;
            $sc->selected = $selected;

            if ($sc->save()) {
                return redirect()->back();
            }

            return redirect()->back()->with('error', __('alerts.datatables.save_columns.error'));

        }

        return redirect()->back()->with('error', __('alerts.datatables.save_columns.error_data'));
    }

    /**
     * Process dataTables needed render output.
     *
     * @phpstan-param view-string|null $view
     */
    final public function render(?string $view = null, array $data = array(), array $mergeData = array()): mixed
    {
        if ($this->request()->ajax() && $this->request()->wantsJson()) {
            return app()->call($this->ajax(...));
        }

        /** @var string $action */
        $action = $this->request()->get('action');
        $actionMethod = 'print' === $action ? 'printPreview' : $action;

        if (in_array($action, $this->actions) && method_exists($this, $actionMethod)) {
            /** @var callable $callback */
            $callback = array($this, $actionMethod);

            return app()->call($callback);
        }

        /** @phpstan-ignore-next-line  */
        return view($view, $data, $mergeData)->with($this->dataTableVariable, $this->getHtmlBuilder());
    }

    public function userView($data, $relation)
    {
        if ($data->{$relation}) {
            return view('components.datatables.username_link', array(
                'data' => $data->{$relation},
            ));
        }

        return '';
    }

    protected function selectedColumns(): array
    {
        $columns = array();
        $model = SelectedColumns::findColumn($this->id);
        $columns_raw = $model->selected ?? array();
        $available = $this->availableColumns();

        if (empty($columns_raw)) {
            $columns = $this->defaultColumns();
        } else {
            $columns = array_filter($columns_raw, fn ($c) => array_key_exists($c, $available));
        }

        return $columns;
    }

    protected function defaultColumns(): array
    {
        return array();
    }

    protected function availableColumns(): array
    {
        return array();
    }

    protected function getOrderBy(): ?int
    {
        $orderBy = null;
        if ($this->orderBy) {
            $columns = $this->getColumns();
            if ( ! empty($columns)) {
                foreach ($columns as $key => $column) {
                    if ($column->name === $this->orderBy) {
                        $orderBy = $key;
                        break;
                    }
                }
            }
        }

        return $orderBy;
    }

    public function json()
    {
        $collection = $this->getDataForExport();
        $filename = $this->getFilename() . '.json';
        $fullpath = storage_path('app/public/' . $filename);
        File::put($fullpath, json_encode($collection, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));

        return response()->download($fullpath, $filename);
    }
}
