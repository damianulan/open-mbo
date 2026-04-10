<?php

namespace App\Console\Commands\Core\Issues\Traits;

use App\Console\Commands\Core\Issues\Enums\IssueType;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

trait StorageIssues
{
    protected const PATH = 'issues/config.json';

    protected $typeMap = [
        'feature' => 'feat',
        'bug' => 'fix',
        'refactor' => 'ref',
    ];

    public function validateCommitMessage(string $message): bool
    {
        $config = $this->getConfigContents();
        if (isset($config['changelog']) && is_array($config['changelog'])) {
            if (in_array($message, $config['changelog'])) {
                return false;
            }
        }

        return true;
    }

    public function putIssueConfig(int $id, string $issue, IssueType $type): string
    {
        $typeStr = $type->toString();
        $id = Str::ltrim($id, '#');
        $message = "{$typeStr}(#{$id}): {$issue}";

        $path = $this->getIssuePath();
        $config = $this->getConfigContents();

        $config['issue'] = $message;

        File::put($path, json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $issue;
    }

    public function getIssue(): ?string
    {
        $config = $this->getConfigContents();
        if (isset($config['issue'])) {
            return $config['issue'];
        }

        return null;
    }

    public function registerCommitMessage(string $message, bool $close = false): void
    {
        $config = $this->getConfigContents();
        $config['changelog'][] = $message;
        if ($close) {
            $config['issue'] = '';
        }
        File::put($this->getIssuePath(), json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    protected function getIssuePath(): string
    {
        return storage_path(self::PATH);
    }

    protected function getBranchName(): string
    {
        $result = Process::run('git rev-parse --abbrev-ref HEAD');

        return mb_trim($result->output());
    }

    private function getConfigContents(): array
    {
        $path = $this->getIssuePath();
        if (File::exists($path)) {
            $config = File::get($path);
            if ($config) {
                return json_decode($config, true);
            }
        }

        return [];
    }
}
