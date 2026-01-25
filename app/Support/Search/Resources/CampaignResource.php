<?php

namespace App\Support\Search\Resources;

use App\Support\Search\Factories\IndexResource;
use App\Models\MBO\Campaign;
use App\Support\Search\Dtos\ResultItem;

class CampaignResource extends IndexResource
{
    public function __construct(Campaign $model)
    {
        return parent::__construct($model);
    }

    public static function getModelClass(): string
    {
        return Campaign::class;
    }

    public function attributes(): array
    {
        return array(
            'name' => $this->model->name,
            'description' => $this->model->description,
            'period' => $this->model->period,
            'stage' => $this->model->stage->label,
        );
    }

    public function resultItem(string $phrase): ResultItem
    {
        return (new ResultItem(array(
            'title' => $this->model->name,
            'description' => $this->model->description,
            'link' => route('campaigns.show', $this->model->id),
        )))->setSearchedPhrase($phrase);
    }
}
