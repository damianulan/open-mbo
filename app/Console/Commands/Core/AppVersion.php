<?php

namespace App\Console\Commands\Core;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use App\Settings\GeneralSettings;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class AppVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating app version';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $result = Process::run('git describe --tags --abbrev=0');
        $settings = new GeneralSettings();
        if ($settings) {
            $name = $settings->site_name ?? 'OpenMBO';
            $version = $settings->release ?? null;
            $new_version = trim($result->output());

            if ($new_version && strpos($new_version, '.') !== false) {

                $newVersionStyle = new OutputFormatterStyle('white', 'yellow', ['bold']);
                $this->output->getFormatter()->setStyle('newversionblock', $newVersionStyle);
                $newVersionStyle = new OutputFormatterStyle('white', 'green', ['bold']);
                $this->output->getFormatter()->setStyle('versionblock', $newVersionStyle);

                $this->line(PHP_EOL);

                if ($version !== $new_version) {
                    $settings->release = $new_version;
                    if ($settings->save()) {
                        $this->line("New $name version detected: <newversionblock>$new_version</newversionblock>");
                    }
                } else {
                    $this->line("Current $name version: <versionblock>$version</versionblock>");
                }

                $this->line(PHP_EOL);
            }
        }
    }
}
