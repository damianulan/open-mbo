<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    public function createApplication(): Application
    {
        $compiledPath = dirname(__DIR__) . '/storage/framework/testing/views';
        if (! is_dir($compiledPath)) {
            mkdir($compiledPath, 0777, true);
        }

        putenv('VIEW_COMPILED_PATH=' . $compiledPath);
        $_ENV['VIEW_COMPILED_PATH'] = $compiledPath;
        $_SERVER['VIEW_COMPILED_PATH'] = $compiledPath;

        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
