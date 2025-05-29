<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MBO\ObjectiveTemplateCategory;
use App\Models\MBO\Campaign;
use Carbon\Carbon;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\Objective;
use App\Models\Core\User;

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

        ObjectiveTemplate::factory(200)->create();

        $templates = ObjectiveTemplate::all();
        $users = User::all();

        for ($i = 1; $i <= 50; $i++) {
            $datetime = fake()->dateTimeBetween('-3 weeks', '+2 months');
            $now = Carbon::parse($datetime);
            $campaign = new Campaign();
            $campaign->name = 'Testowa kampania ' . $i;
            $campaign->period = '2025 Q' . $i;
            $campaign->description = fake()->paragraph(2);
            $campaign->definition_from = $now->format('Y-m-d') . ' 00:00:00';
            $campaign->definition_to = $now->addDays(3)->format('Y-m-d') . ' 23:59:59';
            $campaign->disposition_from = $now->addDays(1)->format('Y-m-d') . ' 00:00:00';
            $campaign->disposition_to = $now->addDays(5)->format('Y-m-d') . ' 23:59:59';
            $campaign->realization_from = $now->addDays(1)->format('Y-m-d') . ' 00:00:00';
            $campaign->realization_to = $now->addDays(fake()->numberBetween(1, 15))->format('Y-m-d') . ' 23:59:59';
            $campaign->evaluation_from = $now->addDays(1)->format('Y-m-d') . ' 00:00:00';
            $campaign->evaluation_to = $now->addDays(5)->format('Y-m-d') . ' 23:59:59';
            $campaign->self_evaluation_from = $now->addDays(1)->format('Y-m-d') . ' 00:00:00';
            $campaign->self_evaluation_to = $now->addDays(5)->format('Y-m-d') . ' 23:59:59';
            $campaign->draft = 0;
            $campaign->manual = 0;
            $campaign->save();

            $campaignTemplates = $templates->pop(fake()->numberBetween(2, 6));

            foreach ($campaignTemplates as $template) {
                if ($template && isset($template->id) && $campaign) {
                    for ($j = 1; $j <= fake()->numberBetween(1, 3); $j++) {
                        $objective = new Objective();
                        $objective->campaign_id = $campaign->id;
                        $objective->template_id = $template->id;
                        $objective->name = $template->name . "[$j]";
                        $objective->description = fake()->paragraph(2);
                        $objective->weight = fake()->randomFloat(2, 0, 1);
                        $objective->expected = fake()->numberBetween(1000, 5500);
                        $objective->award = fake()->randomFloat(2, 1, 100);
                        $objective->draft = 0;
                        $objective->save();
                    }
                }
            }

            $tempUsers = $users->random(fake()->numberBetween(4, 10));
            foreach ($tempUsers as $user) {
                if ($user && isset($user->id)) {
                    $campaign->assignUser($user->id);
                }
            }
        }
    }
}
