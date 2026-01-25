<?php

namespace App\Support\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SearchEngine
{
    public function __construct(protected string $input){}

    public static function boot(string $input): self
    {
        $instance = new static($input);

        return $instance;
    }

    public function canSearch(): bool
    {
        return ! empty($this->input) && strlen($this->input) >= 3;
    }

    public function query(): Builder
    {
        return IndexModel::search($this->input);
    }

    public function get(): Collection
    {
        return $this->canSearch() ? $this->query()->get()->map(fn (IndexModel $index) => $index->result_item) : new Collection();
    }

    public function getPaginator(): LengthAwarePaginator
    {
        return $this->query()->paginate();
    }

    public function count(): int
    {
        return $this->canSearch() ? $this->query()->count() : 0;
    }
}
