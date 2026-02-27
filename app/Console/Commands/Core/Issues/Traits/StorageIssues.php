<?php

namespace App\Console\Commands\Core\Issues\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait StorageIssues
{
    protected const PATH = 'issues/config.json';

    protected function getIssuePath(): string
    {
        return storage_path(self::PATH);
    }

    private function normalizeIssue(string $issue): string
    {
        return Str::upper(Str::slug($issue));
    }

    private function getConfigContents(): array
    {
        $path = $this->getIssuePath();
        if(File::exists($path)) {
            $config = File::get($path);
            if($config) {
                return json_decode($config, true);
            }
        }
        return [];
    }

    public function validateCommitMessage(string $message): bool
    {
        $config = $this->getConfigContents();
        if(isset($config['changelog']) && is_array($config['changelog'])) {
            if(in_array($message, $config['changelog'])) {
                return false;
            }
        }

        return true;
    }

    public function putIssueConfig(string $issue): string
    {
        $issue = $this->normalizeIssue($issue);
        if(empty($issue)) {
            throw new \Exception('Empty issue provided');
        }
        $path = $this->getIssuePath();
        $config = $this->getConfigContents();

        File::put($path, json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $issue;
    }

    public function getIssue(): ?string
    {
        $config = $this->getConfigContents();
        if(isset($config['issue'])) {
            return $config['issue'];
        }
        return null;
    }

    public function registerCommitMessage(string $message): void
    {
        $config = $this->getConfigContents();
        $config['changelog'][] = $message;
        $config['issue'] = "";
        File::put($this->getIssuePath(), json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
