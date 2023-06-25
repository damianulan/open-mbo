<?php

namespace App\Enums\Elearning;

enum EnrolmentType: string
{
    case MANUAL = 'manual';
    case PATH = 'path';
    case BLENDED = 'blended';
}