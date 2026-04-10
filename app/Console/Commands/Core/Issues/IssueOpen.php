<?php

namespace App\Console\Commands\Core\Issues;

use App\Console\Commands\Core\Issues\Enums\IssueType;
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
        $typeInput = $this->ask('What is the issue type? (bug / feature)');
        $type = IssueType::from($typeInput);

        $this->info("Issue ID: #{$id}");
        $this->info("Issue title: {$issue}");
        $this->info("Issue type: {$type->name}");

        $issue = $this->putIssueConfig($id, $issue, $type);
        $branchName = $type->branchPrefix() . '-' . $id;
        $result = Process::run('git fetch --all');
        $result = Process::run('git pull');
        $result = Process::run('git checkout -b ' . $branchName);
        $this->line($result->output());
        $this->info("Issue registered: {$issue}");

        return true;
    }
}
