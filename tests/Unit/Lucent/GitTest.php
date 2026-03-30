<?php

namespace Tests\Unit\Lucent;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Lucent\Console\Git;
use Lucent\Console\GitResult;
use Tests\TestCase;

class GitTest extends TestCase
{
    protected string $repositoryPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoryPath = storage_path('framework/testing/git-' . uniqid());

        File::ensureDirectoryExists($this->repositoryPath);

        $this->runGit(['git', 'init', '-b', 'main']);
        $this->runGit(['git', 'config', 'user.email', 'tests@example.com']);
        $this->runGit(['git', 'config', 'user.name', 'Lucent Tests']);

        File::put($this->repositoryPath . '/README.md', "first\n");

        $this->runGit(['git', 'add', 'README.md']);
        $this->runGit(['git', 'commit', '-m', 'Initial commit']);
        $this->runGit(['git', 'tag', 'v1.0.0']);

        File::put($this->repositoryPath . '/README.md', "second\n");

        $this->runGit(['git', 'add', 'README.md']);
        $this->runGit(['git', 'commit', '-m', 'Second commit']);
        $this->runGit(['git', 'tag', 'v1.1.0']);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->repositoryPath);

        parent::tearDown();
    }

    public function test_it_reads_branch_and_tags_from_a_repository(): void
    {
        $this->assertSame('main', Git::head($this->repositoryPath));
        $this->assertSame('v1.1.0', Git::getLatestTagName($this->repositoryPath));
        $this->assertSame(['v1.1.0', 'v1.0.0'], Git::getTags($this->repositoryPath, fetch: false));
    }

    public function test_it_collects_structured_results_for_queued_commands(): void
    {
        $git = Git::repository($this->repositoryPath)
            ->queue(['git', 'status', '--short'])
            ->queue(['git', 'rev-parse', '--abbrev-ref', 'HEAD'])
            ->run();

        $results = $git->results();

        $this->assertCount(2, $results);
        $this->assertContainsOnlyInstancesOf(GitResult::class, $results);
        $this->assertSame('git rev-parse --abbrev-ref HEAD', $git->lastResult()?->commandString());
        $this->assertSame('main', trim($git->lastOutput()));
        $this->assertTrue($git->successful());
    }

    public function test_it_can_checkout_a_specific_release(): void
    {
        Git::checkoutRelease('v1.0.0', $this->repositoryPath);

        $result = Process::path($this->repositoryPath)->run(['git', 'describe', '--tags', '--exact-match']);

        $this->assertSame('v1.0.0', trim($result->output()));
    }

    /**
     * @param array<int, string> $command
     */
    protected function runGit(array $command): void
    {
        $result = Process::path($this->repositoryPath)->run($command);

        $this->assertTrue(
            $result->successful(),
            sprintf(
                "Git command failed: %s\n%s",
                implode(' ', $command),
                $result->errorOutput() ?: $result->output(),
            ),
        );
    }
}
