<?php

namespace App\Support\Filters\Services;

use App\Support\Filters\Contracts\FilterContract;
use App\Support\Filters\Factories\FilterFinderFactory;
use App\Support\Filters\Factories\FilterFormFactory;
use ArrayIterator;
use Countable;
use FormForge\Base\Form;
use FormForge\FormBuilder;
use IteratorAggregate;
use Traversable;
use Illuminate\Contracts\Support\Renderable;

class FilterService implements Countable, IteratorAggregate, Traversable
{
    private array $items = [];

    public function __construct($items = [])
    {
        foreach ($items as $item) {
            $this->push($item);
        }
    }

    public function push(string|FilterContract $filter): self
    {
        $this->items[] = FilterFinderFactory::make($filter);

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getFormDefinition(): FormBuilder
    {
        return $this->buildForm()->getDefinition();
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function isFilled(): bool
    {
        return ! $this->isEmpty();
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    protected function buildForm(): Form
    {
        return FilterFormFactory::make($this);
    }

    public function getForm(): ?Renderable
    {
        if ($this->isFilled()) {
            return view('components.filters.form', [
                'form' => $this->getFormDefinition(),
            ]);
        }

        return null;
    }
}
