<?php

namespace App\Console\Commands\Core;

use App\Events\Core\AppUpgraded;
use App\Settings\GeneralSettings;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Schema;
use Lucent\Console\Git;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class AppUpgrade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:upgrade {--nocomposer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upgrading app with git repository';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $local = config('app.env') === 'local';
        $runComposer = $this->option('nocomposer') ? false : true;
        $this->line('Checking for updates...');
        try {
            Log::debug('Upgrade check initialized');
            $newVersionStyle = new OutputFormatterStyle('white', 'yellow', ['bold']);
            $this->output->getFormatter()->setStyle('newversionblock', $newVersionStyle);
            $newVersionStyle = new OutputFormatterStyle('white', 'blue', ['bold']);
            $this->output->getFormatter()->setStyle('versionblock', $newVersionStyle);
            if (! Schema::hasTable('settings')) {
                throw new \Exception('Settings table is not created!');
            }
            $settings = new GeneralSettings;
            $name = $settings->site_name ?? env('APP_NAME');
            $target_release = $settings->target_release ?? 'stable';

            $this->line("Version preference detected: <versionblock>$target_release</versionblock>");

            $latestRelease = Git::getLatestTagName();
            if (empty($latestRelease)) {
                throw new \Exception('Unable to get latest release tag.');
            }

            $git_branch = match ($target_release) {
                'stable' => 'master',
                'non-stable' => $latestRelease,
                'dev' => 'dev',
                default => $target_release,
            };

            $this->line("Checking to $git_branch branch/tag");
            $result = Process::run('git fetch --all');
            if (! $local) {
                $result = Process::run('git reset --hard');
            }
            $result = Process::run("git checkout $git_branch");
            $output = $result->output();
            if (! $result->successful()) {
                throw new \Exception("Unable to switch to branch/tag: {$git_branch} ".$output);
            }
            $result = Process::run('git pull');

            if ($runComposer) {
                $composer_exec = env('COMPOSER_EXECUTABLE', 'composer update');
                $result = Process::timeout(1200)->run($composer_exec);
                $output = $result->output();

                if (! $result->successful()) {
                    throw new \Exception('Composer update failed: '.$output);
                }
                $this->line('Composer finished successfully');
            }

            Artisan::call('migrate');
            $this->info(Artisan::output());
            $this->line(PHP_EOL);

            if ($target_release !== $settings->release) {
                $settings->release = $target_release;
                if ($settings->save()) {
                    $this->line("New $name version detected: <newversionblock>^$target_release</newversionblock>");
                    AppUpgraded::dispatch($target_release);
                    Log::debug('App upgraded to '.$target_release);
                }
            } else {
                $this->line("Current $name version: <versionblock>$target_release</versionblock>");
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->error($th->getMessage());

            return false;
        }

        return true;
    }
}
