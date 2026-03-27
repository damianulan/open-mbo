<?php

namespace App\Support\Filters\Services;

use App\Support\Filters\Contracts\FilterCollection;
use App\Support\Filters\Contracts\FilterContract;
use App\Support\Filters\Factories\FilterFinderFactory;
use App\Support\Filters\Factories\FilterFormFactory;
use ArrayIterator;
use FormForge\Base\Form;
use FormForge\FormBuilder;
use Illuminate\Contracts\Support\Renderable;
use Traversable;

class FilterService implements FilterCollection
{
    protected array $items = [];

    public function __construct($items = [])
    {
        foreach ($this->items as $key => $item) {
            unset($this->items[$key]);
            $this->push($item);
        }
        foreach ($items as $item) {
            $this->push($item);
        }

        $this->items = array_values($this->items);
    }

    public function push(string|FilterContract $filter): static
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

    public function getForm(): ?Renderable
    {
        if ($this->isFilled()) {
            return view('components.filters.form', [
                'form' => $this->getFormDefinition(),
            ]);
        }

        return null;
    }

    protected function buildForm(): Form
    {
        return FilterFormFactory::make($this);
    }
}
