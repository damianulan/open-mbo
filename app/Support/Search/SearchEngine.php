<?php

namespace App\Support\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SearchEngine
{
    public function __construct(protected string $input) {}

    public static function boot(string $input): self
    {
        $instance = new static($input);

        return $instance;
    }

    public function canSearch(): bool
    {
        return ! empty($this->input) && mb_strlen($this->input) >= 3;
    }

    public function query(): Builder
    {
        return IndexModel::search($this->input);
    }

    public function get(): Collection
    {
        return $this->canSearch() ? $this->query()->get()->map(fn (IndexModel $index) => $index->resource?->resultItem($this->input)) : new Collection();
    }

    public function getPaginator(int $perPage = 20): LengthAwarePaginator
    {
        $paginator = $this->query()->paginate($perPage);
        $collection = $paginator->getCollection();

        return $paginator->setCollection($collection->map(fn (IndexModel $index) => $index->resource?->resultItem($this->input)));
    }

    public function count(): int
    {
        return $this->canSearch() ? $this->query()->count() : 0;
    }

    public function getInput(): string
    {
        return $this->input;
    }
}
