<?php

namespace App\Console\Commands\Core\Issues\Enums;

enum IssueType: string
{
    case BUG = 'bug';
    case FEATURE = 'feature';
    case REFACTOR = 'refactor';

    public function toString(): ?string
    {
        return match ($this) {
            self::BUG => 'fix',
            self::FEATURE => 'feat',
            self::REFACTOR => 'ref',
            default => null,
        };
    }

    public function branchPrefix(): ?string
    {
        return match ($this) {
            self::BUG => 'fix',
            self::FEATURE => 'feat',
            self::REFACTOR => 'refactor',
            default => null,
        };
    }
}
