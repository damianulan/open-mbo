<?php

namespace App\Console\Commands\Core;

use App\Console\Commands\Core\Issues\Traits\StorageIssues;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AddChangelogNotes extends Command
{
    use StorageIssues;

    protected $signature = 'changelog:publish
                            {version? : Optional version number (e.g. 1.2.0)}
                            {count? : Optional number of last commits}';

    protected $description = 'Append git commits to CHANGELOG.md under a given version';

    public function handle(): int
    {
        $version = $this->resolveVersion($this->argument('version'));
        $count = $this->argument('count');

        if ($version === null) {
            $this->error('Unable to detect the next version automatically. Provide a version argument explicitly.');

            return Command::FAILURE;
        }

        $commits = $count
            ? $this->getLastNCommits((int) $count)
            : $this->getCommitsSinceLastTag();

        if (empty($commits)) {
            $this->error('No commits found.');

            return Command::FAILURE;
        }

        $changelogPath = base_path('CHANGELOG.md');

        $date = now()->format('Y-m-d');
        $markdown = $this->buildMarkdown($version, $date, $commits);

        if (! File::exists($changelogPath)) {
            File::put($changelogPath, '# Changelog

');
        }

        $existing = File::get($changelogPath);
        $updated = preg_replace(
            '/# Changelog\s*/',
            '# Changelog

' . $markdown,
            $existing,
            1,
        );

        File::put($changelogPath, $updated);

        $this->info("Changelog updated successfully for version {$version}.");

        return Command::SUCCESS;
    }

    protected function getLastNCommits(int $count): array
    {
        if ($count <= 0) {
            return [];
        }

        $command = sprintf(
            'git log -n %d --pretty=format:"%%s" --no-merges',
            $count,
        );

        exec($command, $output);

        return $this->processCommits($output);
    }

    protected function getCommitsSinceLastTag(): array
    {
        exec('git describe --tags --abbrev=0', $tagOutput, $tagResult);

        if ($tagResult !== 0 || empty($tagOutput)) {
            exec('git log --pretty=format:"%s" --no-merges', $output);

            return $output;
        }

        $lastTag = mb_trim($tagOutput[0]);

        $command = sprintf(
            'git log %s..HEAD --pretty=format:"%%s" --no-merges',
            $lastTag,
        );

        exec($command, $output);

        return $this->processCommits($output);
    }

    protected function resolveVersion(?string $version): ?string
    {
        if ($version !== null && $version !== '') {
            return $version;
        }

        return $this->detectNextVersion();
    }

    protected function detectNextVersion(): ?string
    {
        $currentVersion = $this->getLatestVersionFromChangelog()
            ?? $this->getLatestVersionFromGitTag();

        if ($currentVersion === null) {
            return null;
        }

        return $this->incrementPatchVersion($currentVersion);
    }

    protected function getLatestVersionFromChangelog(): ?string
    {
        $changelogPath = base_path('CHANGELOG.md');

        if (! File::exists($changelogPath)) {
            return null;
        }

        preg_match_all('/^##\s+\[?v?(\d+\.\d+\.\d+)\]?/m', File::get($changelogPath), $matches);

        return $matches[1][0] ?? null;
    }

    protected function getLatestVersionFromGitTag(): ?string
    {
        exec('git tag --sort=-v:refname', $tagOutput, $tagResult);

        if ($tagResult !== 0 || empty($tagOutput)) {
            return null;
        }

        foreach ($tagOutput as $tag) {
            if (preg_match('/^v?(\d+\.\d+\.\d+)$/', mb_trim($tag), $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    protected function incrementPatchVersion(string $version): string
    {
        [$major, $minor, $patch] = array_map('intval', explode('.', $version));

        return sprintf('%d.%d.%d', $major, $minor, $patch + 1);
    }

    protected function buildMarkdown(string $version, string $date, array $commits): string
    {
        $output = "## [{$version}] - {$date}

";
        $output .= '### Changes

';

        foreach ($commits as $commit) {
            $output .= "- {$commit}
";
        }

        $output .= '
';

        return $output;
    }

    protected function processCommits(array $commits): array
    {
        $output = [];

        foreach ($commits as $commit) {
            $commit = mb_trim($commit);

            if ('' === $commit || ! preg_match('/[[:alpha:]]{2,}/u', $commit)) {
                continue;
            }

            $key = Str::slug($commit);

            if ('' === $key) {
                continue;
            }

            $output[$key] = $commit;
        }

        return array_values($output);
    }
}
