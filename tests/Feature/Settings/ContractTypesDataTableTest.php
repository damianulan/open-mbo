<?php

namespace Tests\Feature\Settings;

use App\DataTables\Management\ContractTypesDataTable;
use Tests\TestCase;

class ContractTypesDataTableTest extends TestCase
{
    public function test_contract_types_datatable_columns_match_type_of_contract_attributes(): void
    {
        $dataTable = new class () extends ContractTypesDataTable {
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
