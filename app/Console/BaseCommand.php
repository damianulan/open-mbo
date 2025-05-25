<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Artisan;
use App\Notifications\System\AppRefreshNotification;
use App\Models\Core\User;
use App\Console\Commands\Core\MailTest;
use Illuminate\Support\Carbon;

class BaseCommand extends Command
{
    private $start = null;
    private $end = null;

    protected function log($message, $success = true)
    {

        $this->end = Carbon::now();
        $duration = null;

        $properties = [
            'job' => static::class
        ];
        if ($this->start && $this->end) {
            $diffMs = $this->end->valueOf() - $this->start->valueOf();
            $seconds = floor($diffMs / 1000);
            $milliseconds = $diffMs % 1000;

            $duration = "{$seconds}. {$milliseconds}";
        }

        if (!empty($duration)) {
            $properties['duration'] = $duration;
        }

        $result = $success ? 'success' : 'failure';
        $message = static::class . ' : ' . $message;
        activity('cron')
            ->event($result)
            ->withProperties($properties)
            ->log($message)
        ;
    }

    protected function logStart()
    {
        $this->start = Carbon::now();
    }
}
