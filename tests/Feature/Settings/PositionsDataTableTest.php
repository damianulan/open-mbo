<?php

namespace Tests\Feature\Settings;

use App\DataTables\Management\PositionsDataTable;
use Tests\TestCase;

class PositionsDataTableTest extends TestCase
{
    public function test_positions_datatable_columns_match_position_attributes(): void
    {
        $dataTable = new class () extends PositionsDataTable {
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
            'created_at',
            'updated_at',
            'action',
        ], $dataTable->exposedDefaultColumns());

        $this->assertSame([
            'name',
            'created_at',
            'updated_at',
            'action',
        ], array_keys($dataTable->exposedAvailableColumns()));
    }
}
