<?php

namespace Tests\Feature\Database;

use Illuminate\Support\Str;
use Tests\TestCase;

class MigrationsConsistencyTest extends TestCase
{
    public function test_all_migrations_define_down_method(): void
    {
        $files = glob(database_path('migrations/*.php'));
        $missingDown = [];

        foreach ($files as $file) {
            $contents = file_get_contents($file);

            if ($contents === false) {
                $this->fail('Unable to read migration file: ' . $file);
            }

            if (! Str::contains($contents, 'public function down(): void')) {
                $missingDown[] = basename($file);
            }
        }

        $this->assertSame([], $missingDown, 'Migrations missing down(): ' . implode(', ', $missingDown));
    }

    public function test_create_migrations_drop_the_same_tables_in_down(): void
    {
        $files = glob(database_path('migrations/*.php'));
        $mismatches = [];

        foreach ($files as $file) {
            $contents = file_get_contents($file);

            if ($contents === false) {
                $this->fail('Unable to read migration file: ' . $file);
            }

            preg_match_all("/Schema::create\\('([^']+)'/", $contents, $createMatches);
            preg_match_all("/dropIfExists\\('([^']+)'/", $contents, $dropMatches);

            $createdTables = $createMatches[1] ?? [];
            $droppedTables = $dropMatches[1] ?? [];

            if ($createdTables === [] || $droppedTables === []) {
                continue;
            }

            sort($createdTables);
            sort($droppedTables);

            if ($createdTables !== $droppedTables) {
                $mismatches[] = basename($file) . ' (create: ' . implode(',', $createdTables) . '; drop: ' . implode(',', $droppedTables) . ')';
            }
        }

        $this->assertSame([], $mismatches, 'Create/drop table mismatch in migrations: ' . implode(' | ', $mismatches));
    }
}
