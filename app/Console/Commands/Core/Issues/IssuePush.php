<?php

namespace App\Console\Commands\Core\Issues;

use App\Console\Commands\Core\Issues\Traits\StorageIssues;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class IssuePush extends Command
{
    use StorageIssues;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'issue:push {message?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upgrading app with git repository';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $issue = $this->getIssue();
            $message = $this->argument('message');
            if ( ! empty($issue)) {

                $result = Process::run('git fetch --all');
                $result = Process::run('whoami');
                $this->line($result->output());
                $this->info("Opened issue detected: {$issue}");
                if ( ! empty($message)) {
                    $this->info("Commit message: {$message}");
                    $issue .= ': ' . $message;
                } else {
                    $this->warn('No commit message provided!');
                }

                $answer = Str::lower($this->ask('Proceed? (y/n)', 'n'));
                $proceed = 'y' === $answer;
                if ($proceed) {
                    if ( ! $this->validateCommitMessage($issue)) {
                        throw new Exception("Commit message was already been pushed: {$issue}");
                    }
                    $this->comment('Pushing issue ...');
                    $result = Process::run('git add .');
                    $result = Process::run('git commit -m "' . $issue . '"');
                    $result = Process::run('git push');
                    $this->line($result->output());

                    $this->registerCommitMessage($issue);
                } else {
                    $this->info('Aborted.');
                }

            } else {
                $this->error('No issue registered.');
            }
        } catch (Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
