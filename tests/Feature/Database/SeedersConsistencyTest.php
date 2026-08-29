<?php

namespace Tests\Feature\Database;

use App\Models\Business\Company;
use App\Models\Business\Position;
use App\Models\Business\TypeOfContract;
use App\Models\Core\User;
use Database\Seeders\BusinessSeeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SeedersConsistencyTest extends TestCase
{
    use RefreshDatabase;

    protected $seeder = TestDatabaseSeeder::class;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        config(['cache.default' => 'array']);
        config(['model-cache.cache_store' => 'array']);
        Queue::fake();
    }

    public function test_create_admin_user_seeder_is_idempotent(): void
    {
        $emails = [
            'admin@damianulan.me',
            'kontakt@damianulan.me',
            'helpdesk@damianulan.me',
        ];

        $this->seed(CreateAdminUserSeeder::class);
        $this->seed(CreateAdminUserSeeder::class);

        foreach ($emails as $email) {
            $this->assertSame(1, User::query()->where('email', $email)->count());
        }
    }

    public function test_business_seeder_does_not_duplicate_base_records(): void
    {
        $this->seed(BusinessSeeder::class);

        $contractsCount = TypeOfContract::query()->count();
        $positionsCount = Position::query()->count();
        $companiesCount = Company::query()->count();

        $this->seed(BusinessSeeder::class);

        $this->assertSame(count(TypeOfContract::$contracts), $contractsCount);
        $this->assertSame($contractsCount, TypeOfContract::query()->count());
        $this->assertSame($positionsCount, Position::query()->count());
        $this->assertSame($companiesCount, Company::query()->count());
        $this->assertSame(0, Company::query()->doesntHave('departments')->count());
    }
}
