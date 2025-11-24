<?php

namespace Database\Seeders;

use App\Console\Commands\MBO\MBOVerifyStatusScript;
use App\Models\Core\User;
use App\Models\MBO\BonusScheme;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Models\MBO\UserObjective;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\ObjectiveTemplateCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Throwable;

class MBOSeeder extends Seeder
{
    protected $users;
    protected $templates;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ObjectiveTemplateCategory::count() > 0) {
            return;
        }
        try {
            DB::beginTransaction();
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

            ObjectiveTemplate::factory(350)->create();

            $this->templates = ObjectiveTemplate::all();
            $this->users = User::all();

            BonusScheme::factory(10)->create();
            $bonusSchemes = BonusScheme::all();

            foreach ($this->users as $user) {
                $bonusScheme = $bonusSchemes->random(1)->first();
                $user->assignBonusScheme($bonusScheme);
            }
            $this->objectives();
            $this->campaigns();

            Artisan::call(MBOVerifyStatusScript::class);

            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function objectives(): void
    {
        $templates = $this->templates->random(fake()->numberBetween(80, 120));
        foreach ($templates as $template) {
            if ($template && isset($template->id)) {
                for ($j = 1; $j <= fake()->numberBetween(1, 3); $j++) {
                    $objective = new Objective();
                    $objective->template_id = $template->id;
                    $objective->name = $template->name . "[{$j}]";
                    $objective->description = fake()->text(fake()->numberBetween(150, 250));
                    $objective->weight = fake()->randomFloat(2, 0.1, 1);
                    $objective->expected = fake()->numberBetween(1000, 5500);
                    $objective->award = fake()->randomFloat(2, 1, 100);
                    $objective->draft = 0;
                    $objective->save();

                    if ($objective->id) {
                        $tempUsers = $this->users->random(fake()->numberBetween(4, 10));
                        foreach ($tempUsers as $user) {
                            if ($user && isset($user->id)) {
                                UserObjective::assign($user->id, $objective->id);
                            }
                        }
                    }
                }
            }
        }
    }

    public function campaigns(): void
    {
        $coordinatorUsers = $this->users->random(fake()->numberBetween(10, 20));

        for ($i = 1; $i <= 50; $i++) {
            $datetime = fake()->dateTimeBetween('-3 weeks', '+2 months');
            $now = Carbon::parse($datetime);
            $campaign = new Campaign();
            $campaign->name = [
                'pl' => 'Testowa kampania ' . $i,
                'en' => 'Test campaign ' . $i,
                'it' => 'Campagna di prova ' . $i,
            ];
            $campaign->period = '2025 Q' . fake()->numberBetween(1, 4);
            $campaign->description = fake()->text(fake()->numberBetween(500, 1000));
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

            $campaignTemplates = $this->templates->pop(fake()->numberBetween(2, 6));

            foreach ($campaignTemplates as $template) {
                if ($template && isset($template->id) && $campaign) {
                    for ($j = 1; $j <= fake()->numberBetween(1, 3); $j++) {
                        $objective = new Objective();
                        $objective->campaign_id = $campaign->id;
                        $objective->template_id = $template->id;
                        $objective->name = $template->name . "[{$j}]";
                        $objective->description = fake()->text(fake()->numberBetween(150, 250));
                        $objective->weight = fake()->randomFloat(2, 0.1, 1);
                        $objective->expected = fake()->numberBetween(1000, 5500);
                        $objective->award = fake()->randomFloat(2, 1, 100);
                        $objective->draft = 0;
                        $objective->save();
                    }
                }
            }

            $tempUsers = $this->users->random(fake()->numberBetween(4, 10));
            foreach ($tempUsers as $user) {
                if ($user && isset($user->id)) {
                    $campaign->assignUser($user->id);
                }
            }

            $coordinators = $coordinatorUsers->random(fake()->numberBetween(1, 3));
            $campaign->refreshCoordinators($coordinators->pluck('id')->toArray());
        }
    }
}
