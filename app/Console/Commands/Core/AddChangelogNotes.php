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
                            {version : The version number (e.g. 1.2.0)}
                            {count? : Optional number of last commits}';

    protected $description = 'Append git commits to CHANGELOG.md under a given version';

    public function handle(): int
    {
        $version = $this->argument('version');
        $count = $this->argument('count');

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

        if ( ! File::exists($changelogPath)) {
            File::put($changelogPath, "# Changelog\n\n");
        }

        // Insert at top (after title)
        $existing = File::get($changelogPath);
        $updated = preg_replace(
            '/# Changelog\s*/',
            "# Changelog\n\n" . $markdown,
            $existing,
            1
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
            $count
        );

        exec($command, $output);

        return $this->processCommits($output);
    }

    protected function getCommitsSinceLastTag(): array
    {
        // Get latest tag
        exec('git describe --tags --abbrev=0', $tagOutput, $tagResult);

        if (0 !== $tagResult || empty($tagOutput)) {
            // No tag found → fallback to all commits
            exec('git log --pretty=format:"%s" --no-merges', $output);

            return $output;
        }

        $lastTag = trim($tagOutput[0]);

        $command = sprintf(
            'git log %s..HEAD --pretty=format:"%%s" --no-merges',
            $lastTag
        );

        exec($command, $output);

        return $this->processCommits($output);
    }

    protected function buildMarkdown(string $version, string $date, array $commits): string
    {
        $output = "## [{$version}] - {$date}\n\n";
        $output .= "### Changes\n\n";

        foreach ($commits as $commit) {
            $output .= "- {$commit}\n";
        }

        $output .= "\n";

        return $output;
    }

    protected function processCommits(array $commits): array
    {
        $output = [];
        foreach ($commits as $commit) {
            $wordCount = count(array_filter(explode(' ', $commit), fn ($word) => Str::length($word) > 0 && Str::startsWith($word, array_map(fn ($type) => "{$type}(", $this->typeMap)) && ! in_array($word, ['fix', 'fix:', 'fixes', 'fixes:', 'fixing', 'fixing:', '-'])));
            if ($wordCount > 1) {
                $key = Str::slug($commit);
                $output[$key] = $commit;
            }

        }

        return array_values($output);
    }
}
