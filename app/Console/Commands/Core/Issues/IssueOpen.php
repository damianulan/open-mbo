<?php

namespace App\Console\Commands\Core\Issues;

use App\Console\Commands\Core\Issues\Traits\StorageIssues;
use Illuminate\Console\Command;

class IssueOpen extends Command
{
    use StorageIssues;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'issue:open {issue}';

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
        $issue = $this->putIssueConfig($this->argument('issue'));
        $this->info("Issue registered: {$issue}");

        return true;
    }
}
