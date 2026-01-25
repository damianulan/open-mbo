<?php

namespace App\Support\Search\Dtos;

use DTOs\Dto;

class ResultItem extends Dto
{
    protected $fillable = [
        'title',
        'description',
        'link'
    ];
}
