<?php

namespace Tests\Feature\Settings;

use App\DataTables\Management\CompaniesDataTable;
use Tests\TestCase;

class CompaniesDataTableTest extends TestCase
{
    public function test_companies_datatable_columns_match_company_attributes(): void
    {
        $dataTable = new class extends CompaniesDataTable
        {
            public function exposedDefaultColumns(): array
            {
                return $this->defaultColumns();
            }

            public function exposedAvailableColumns(): array
            {
                return $this->availableColumns();
            }
        };

        $this->assertSame([
            'name',
            'shortname',
            'taxpayerid',
            'founded_at',
            'created_at',
            'updated_at',
            'action',
        ], $dataTable->exposedDefaultColumns());

        $this->assertSame([
            'name',
            'shortname',
            'taxpayerid',
            'founded_at',
            'created_at',
            'updated_at',
            'action',
        ], array_keys($dataTable->exposedAvailableColumns()));
    }
}
