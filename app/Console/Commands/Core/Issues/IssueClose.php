<?php

namespace App\Console\Commands\Core\Issues;

class IssueClose extends IssuePush
{
    /**
     * @var string
     */
    protected $signature = 'issue:close {message?}';

    /**
     * @var string
     */
    protected $description = 'Upgrading app with git repository';

    public function handle(): void
    {
        $this->pushChanges(true);
    }
}
