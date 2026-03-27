<?php

namespace Tests\Feature;

use App\Console\Commands\Core\AddChangelogNotes;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class AddChangelogNotesTest extends TestCase
{
    protected function tearDown(): void
    {
        File::delete(base_path('CHANGELOG.md'));

        parent::tearDown();
    }

    public function test_it_uses_the_explicit_version_argument_when_provided(): void
    {
        $command = new class() extends AddChangelogNotes
        {
            public function resolve(?string $version): ?string
            {
                return $this->resolveVersion($version);
            }
        };

        $this->assertSame('1.2.3', $command->resolve('1.2.3'));
    }

    public function test_it_detects_the_next_version_from_the_latest_changelog_entry(): void
    {
        File::put(base_path('CHANGELOG.md'), <<<'MD'
# Changelog

## [1.2.3] - 2026-03-27

### Changes

- Existing change

## [1.2.2] - 2026-03-20
MD);

        $command = new class() extends AddChangelogNotes
        {
            public function detect(): ?string
            {
                return $this->detectNextVersion();
            }
        };

        $this->assertSame('1.2.4', $command->detect());
    }

    public function test_it_falls_back_to_the_next_git_tag_version_when_changelog_is_missing(): void
    {
        $command = new class() extends AddChangelogNotes
        {
            protected function getLatestVersionFromChangelog(): ?string
            {
                return null;
            }

            protected function getLatestVersionFromGitTag(): ?string
            {
                return '0.0.1';
            }

            public function detect(): ?string
            {
                return $this->detectNextVersion();
            }
        };

        $this->assertSame('0.0.2', $command->detect());
    }

    public function test_it_returns_null_when_no_version_can_be_detected(): void
    {
        $command = new class() extends AddChangelogNotes
        {
            protected function getLatestVersionFromChangelog(): ?string
            {
                return null;
            }

            protected function getLatestVersionFromGitTag(): ?string
            {
                return null;
            }

            public function detect(): ?string
            {
                return $this->detectNextVersion();
            }
        };

        $this->assertNull($command->detect());
    }
}
