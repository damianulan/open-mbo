<?php

namespace App\Support\DataTables;

use App\Support\Filters\Contracts\FilterContract;
use App\Support\Filters\Services\FilterService;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\EloquentDataTable;

class DataTableBuilder extends EloquentDataTable
{
    protected FilterService $filterService;

    public function __construct(Model|EloquentBuilder $model)
    {
        parent::__construct($model);
        $this->filterService = new FilterService;
    }

    public function registerFilters(FilterService $service): self
    {
        $this->filterService = $service;

        return $this;
    }

    public function addFilter(string|FilterContract $filter)
    {
        $this->filterService->push($filter);

        return $this->with('filters', 'fullname');
    }

    protected function filterRecords(): void
    {
        $this->applyFilters();
        parent::filterRecords();

    }

    protected function applyFilters(): void
    {
        $this->query->where(function ($query): void {
            foreach ($this->filterService->getItems() as $filter) {
                $query->filter($filter);
            }
        });

    }
}
