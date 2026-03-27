<?php

namespace App\Support\Filters\Types;

use App\Support\Filters\Base\BaseFilter;
use App\Support\Filters\Contracts\FilterContract;
use App\Support\Filters\Contracts\Types\FilterSearchType;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Request;

class SearchFilter extends BaseFilter implements FilterContract, FilterSearchType
{
    protected $key = null;

    protected $value;

    protected $label;

    protected $queryCallback = null;

    public function __construct(?string $key = null, string $label = '', ?callable $queryCallback = null, $value = null)
    {
        if (null === $key) {
            $this->setDefaultKey();
        }

        $this->loadLabel($label);
        $this->loadValue($value);
        $this->queryCallback = $queryCallback;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getQuery(Builder $query): Builder
    {
        if ($this->queryCallback) {
            $callback = $this->queryCallback;
            $query = $callback($query);
        }

        return null === $this->getValue() ? $query : $this->query($query);
    }

    public function query(Builder $query): Builder
    {
        return $query;
    }

    public function label(): string
    {
        return '';
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    private function loadValue($value): void
    {
        $request = Request::has($this->key) ? Request::input($this->key, null) : Request::input('filters.' . $this->key, null);
        $this->value = null === $value ? $request : $value;
    }

    private function loadLabel($label): void
    {
        $this->label = empty($label) ? $this->label() : $label;
    }
}
