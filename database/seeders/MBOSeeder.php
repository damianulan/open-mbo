<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MBO\ObjectiveTemplateCategory;
use App\Models\MBO\Campaign;

class MBOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ObjectiveTemplateCategory::count() > 0) {
            return;
        }
        $category = new ObjectiveTemplateCategory();
        $category->name = 'Cele Globalne';
        $category->shortname = 'global';
        $category->save();

        $category = new ObjectiveTemplateCategory();
        $category->name = 'Cele Kontrolne';
        $category->shortname = 'audit';
        $category->save();

        $category = new ObjectiveTemplateCategory();
        $category->name = 'Cele Indywidualne';
        $category->shortname = 'individual';
        $category->save();

        $campaign = new Campaign();
        $campaign->name = 'Testowa kampania';
        $campaign->period = '2025 Q4';
        $campaign->description = 'Automatycznie wygenerowana przykładowa kampania';
        $campaign->definition_from = '2025-05-05 00:00:00';
        $campaign->definition_to = '2025-05-05 23:59:59';
        $campaign->disposition_from = '2025-05-06 00:00:00';
        $campaign->disposition_to = '2025-05-10 23:59:59';
        $campaign->realization_from = '2025-05-15 00:00:00';
        $campaign->realization_to = '2025-05-24 23:59:59';
        $campaign->evaluation_from = '2025-05-24 00:00:00';
        $campaign->evaluation_to = '2025-05-28 23:59:59';
        $campaign->self_evaluation_from = '2025-05-28 00:00:00';
        $campaign->self_evaluation_to = '2025-05-31 23:59:59';
        $campaign->draft = 0;
        $campaign->manual = 0;
        $campaign->save();
    }
}
