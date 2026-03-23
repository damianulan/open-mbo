<?php

namespace Tests\Feature\DataTables;

use App\DataTables\Settings\LogsDataTable;
use App\DataTables\Settings\MyLogsDataTable;
use App\DataTables\Users\UsersDataTable;
use App\Models\Core\User;
use App\Models\Vendor\ActivityModel;
use Illuminate\Support\Str;
use Tests\TestCase;

class JoinlessDataTableQueryTest extends TestCase
{
    public function test_users_datatable_query_uses_eager_loading_instead_of_joins(): void
    {
        $this->actingAs($this->makeUser());

        $query = app(UsersDataTable::class)->query(new User());

        $this->assertArrayHasKey('employment.position', $query->getEagerLoads());
        $this->assertStringNotContainsString(' join ', mb_strtolower($query->toSql()));
    }

    public function test_logs_datatable_query_uses_eager_loading_instead_of_joins(): void
    {
        $query = app(LogsDataTable::class)->query(new ActivityModel());

        $this->assertArrayHasKey('causer', $query->getEagerLoads());
        $this->assertArrayHasKey('subject', $query->getEagerLoads());
        $this->assertStringNotContainsString(' join ', mb_strtolower($query->toSql()));
    }

    public function test_my_logs_datatable_query_uses_eager_loading_instead_of_joins(): void
    {
        $this->actingAs($this->makeUser());

        $query = app(MyLogsDataTable::class)->query(new ActivityModel());

        $this->assertArrayHasKey('causer', $query->getEagerLoads());
        $this->assertArrayHasKey('subject', $query->getEagerLoads());
        $this->assertStringNotContainsString(' join ', mb_strtolower($query->toSql()));
    }

    private function makeUser(): User
    {
        $user = new User();
        $user->id = (string) Str::uuid();

        return $user;
    }
}
