<?php

namespace App\Console\Commands\Core\Issues;

class IssueClose extends IssuePush
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'issue:close {message?}';

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
        $this->pushChanges(true);
    }
}
