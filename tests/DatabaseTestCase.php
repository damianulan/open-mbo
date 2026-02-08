<?php

namespace Tests;

use Database\Seeders\TestDatabaseSeeder;

abstract class DatabaseTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->seed(TestDatabaseSeeder::class);
    }
}
