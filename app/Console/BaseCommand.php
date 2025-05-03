<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Artisan;
use App\Notifications\System\AppRefreshNotification;
use App\Models\Core\User;
use App\Console\Commands\Core\MailTest;

class BaseCommand extends Command
{

    protected function log($message, $success = true)
    {
        $result = $success ? 'success' : 'failure';
        $message = static::class . ' : ' . $message;
        activity('cron')
            ->event($result)
            ->withProperties(['job' => static::class])
            ->log($message)
        ;
    }
}
