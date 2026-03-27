<?php

namespace App\Support\Filters\Contracts;

use Countable;
use FormForge\FormBuilder;
use Illuminate\Contracts\Support\Renderable;
use IteratorAggregate;

interface FilterCollection extends IteratorAggregate, \Traversable, Countable
{
    public function __construct($items = []);

    public function push(string|FilterContract $filter): static;

    public function getItems(): array;

    public function getFormDefinition(): FormBuilder;

    public function isEmpty(): bool;

    public function isFilled(): bool;

    public function getForm(): ?Renderable;
}
