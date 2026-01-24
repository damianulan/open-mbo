<?php

namespace App\Support\Search;

use Illuminate\Database\Eloquent\Builder;
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

    public function query(): Builder
    {
        return IndexModel::search($this->input);
    }

    public function get(): Collection
    {
        return $this->query()->get();
    }

    public function getPaginator(): LengthAwarePaginator
    {
        return $this->query()->paginate();
    }

    public function count(): int
    {
        return $this->query()->count();
    }
}
