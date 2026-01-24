<?php

namespace App\Support\Search\Dtos;

use DTOs\Dto;

class SearchItem extends Dto
{
    protected $fillable = [
        'title',
        'description',
        'link'
    ];
}
