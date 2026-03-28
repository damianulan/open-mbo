<?php

namespace App\Support\Filters\Factories;

use App\Support\Filters\Contracts\FilterContract;
use App\Support\Filters\Contracts\Types\FilterSearchType;
use App\Support\Filters\Services\FilterService;
use Exception;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\ForgeComponent;
use FormForge\FormBuilder;

class FilterFormFactory extends Form
{
    protected FilterService $service;

    public static function make(FilterService $service): static
    {
        return (new static)->boot()->setService($service)->setDefinition();
    }

    public function definition(FormBuilder $builder): FormBuilder
    {
        $builder->setMethod('GET')
            ->setTemplate('grid');

        foreach ($this->service->getItems() as $item) {
            $builder->add($this->getComponent($item));
        }

        return $builder;
    }

    public function getComponent(FilterContract $filter): ForgeComponent
    {
        switch ($filter) {
            case $filter instanceof FilterSearchType:
                $component = FormComponent::text($filter->getKey(), $filter->getValue())->label($filter->getLabel())->col(4);
                break;

            default:
                throw new Exception('Invalid filter type');
                break;
        }

        return $component;
    }

    public function validation(): array
    {
        return [];
    }

    protected function setService(FilterService $service): static
    {
        $this->service = $service;

        return $this;
    }
}
