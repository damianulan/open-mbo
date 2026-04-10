<?php

namespace App\Console\Commands\Core;

use App\Settings\GeneralSettings;
use Illuminate\Console\Command;

class Maintenance extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:maintenance {arg}';

    /**
     * @var string
     */
    protected $description = 'Sets a custom maintenance mode ON/OFF [up/down]';

    public function handle(): void
    {
        $type = $this->argument('arg');
        $settings = new GeneralSettings();

        switch ($type) {
            case 'up':
                $this->info('Setting maintenance mode ON');
                $settings->maintenance = true;
                $settings->save();
                break;
            case 'down':
                $this->info('Setting maintenance mode OFF');
                $settings->maintenance = false;
                $settings->save();
                break;
            default:
                $this->error('Unknown parameter setting: try "up" or "down"');
                break;
        }
    }
}
