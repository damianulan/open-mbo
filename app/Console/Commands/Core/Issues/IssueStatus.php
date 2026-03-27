<?php

namespace App\Console\Commands\Core\Issues;

use App\Console\Commands\Core\Issues\Traits\StorageIssues;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class IssueStatus extends Command
{
    use StorageIssues;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'issue:status';

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
            if ( ! empty($issue)) {

                $result = Process::run('git fetch --all');
                $result = Process::run('git status');
                $this->line($result->output());
                $this->info("Opened issue detected: {$issue}");
            } else {
                $this->warn('No issue registered.');
            }
            $this->newLine();
        } catch (Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
