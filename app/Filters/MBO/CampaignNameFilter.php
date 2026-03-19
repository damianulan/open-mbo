<?php

namespace App\Filters\MBO;

use App\Support\Filters\Types\SearchFilter;
use Illuminate\Database\Query\Builder;

class CampaignNameFilter extends SearchFilter
{
    public function label(): string
    {
        return __('forms.campaigns.name');
    }

    public function query(Builder $query): Builder
    {
        return $query->where("name", 'like', "%{$this->getValue()}%");
    }
}
