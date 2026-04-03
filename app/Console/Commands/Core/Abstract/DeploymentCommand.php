<?php

namespace App\Console\Commands\Core\Abstract;

use Illuminate\Console\Command;

abstract class DeploymentCommand extends Command
{
    protected function matchEnvRelease(): string
    {
        return match(config('app.env')) {
            'staging' => 'non-stable',
            'development' => 'dev',
            'local' => 'dev',
            default => 'stable',
        };
    }

    protected function isLocal(): bool
    {
        return config('app.env') === 'local';
    }
}