<?php

namespace App\Dtos;

use DTOs\Dto;
use DTOs\Workshop\PreventAccessingMissingAttributes;
use DTOs\Workshop\ReadOnlyAttributes;

class TestDto extends Dto implements ReadOnlyAttributes, PreventAccessingMissingAttributes
{


}
