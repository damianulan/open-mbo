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

    private function putIssueConfig(string $issue): string
    {
        $issue = $this->normalizeIssue($issue);
        $path = $this->getIssuePath();
        $config = [
            'issue' => $issue
        ];
        File::put($path, json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $issue;
    }

    public function getIssue(): ?string
    {
        $path = $this->getIssuePath();
        if(File::exists($path)) {
            $config = File::get($path);
            if($config) {
                $config = json_decode($config, true);
                if(isset($config['issue'])) {
                    return $config['issue'];
                }
            }
        }
        return null;
    }
}
