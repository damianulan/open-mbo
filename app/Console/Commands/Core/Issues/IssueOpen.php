<?php

namespace App\Console\Commands\Core\Issues;

use App\Console\Commands\Core\Issues\Traits\StorageIssues;
use Illuminate\Console\Command;

class IssueOpen extends Command
{
    use StorageIssues;

    /**
     * @var string
     */
    protected $signature = 'issue:open';

    /**
     * @var string
     */
    protected $description = 'Upgrading app with git repository';

    public function handle()
    {
        $id = $this->ask('What is the issue ID?');
        $issue = $this->ask('What is the issue title?');
        $type = $this->ask('What is the issue type? (bug / feature)');
        $this->info("Issue ID: {$id}");
        $this->info("Issue title: {$issue}");
        $this->info("Issue type: {$type}");

        $issue = $this->putIssueConfig($id, $issue, $type);
        $this->info("Issue registered: {$issue}");

        return true;
    }
}
