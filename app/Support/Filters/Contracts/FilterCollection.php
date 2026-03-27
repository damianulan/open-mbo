<?php

namespace App\Support\Filters\Contracts;

use Countable;
use FormForge\FormBuilder;
use Illuminate\Contracts\Support\Renderable;

interface FilterCollection extends Countable, \IteratorAggregate, \Traversable
{
    public function __construct($items = []);

    public function push(string|FilterContract $filter): static;

    public function getItems(): array;

    public function getFormDefinition(): FormBuilder;

    public function isEmpty(): bool;

    public function isFilled(): bool;

    public function getForm(): ?Renderable;
}
