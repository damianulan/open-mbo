<?php

namespace Tests\Feature\Settings;

use App\DataTables\Management\DepartmentsDataTable;
use Tests\TestCase;

class DepartmentsDataTableTest extends TestCase
{
    public function test_departments_datatable_columns_match_department_attributes(): void
    {
        $dataTable = new class () extends DepartmentsDataTable {
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
            'company',
            'name',
            'created_at',
            'updated_at',
            'action',
        ], $dataTable->exposedDefaultColumns());

        $this->assertSame([
            'company',
            'name',
            'created_at',
            'updated_at',
            'action',
        ], array_keys($dataTable->exposedAvailableColumns()));
    }
}
