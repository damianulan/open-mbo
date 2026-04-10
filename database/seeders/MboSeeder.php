<?php

namespace Database\Seeders;

use App\Console\Commands\Mbo\MBOVerifyStatusScript;
use App\Models\Core\User;
use App\Models\Mbo\BonusScheme;
use App\Models\Mbo\Campaign;
use App\Models\Mbo\Objective;
use App\Models\Mbo\ObjectiveTemplate;
use App\Models\Mbo\ObjectiveTemplateCategory;
use App\Models\Mbo\UserObjective;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Throwable;

class MboSeeder extends Seeder
{
    protected $users;

    protected $templates;

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

            if ($this->templates->isEmpty() || $this->users->isEmpty()) {
                DB::commit();

                return;
            }

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
        $templatesCount = min($this->templates->count(), fake()->numberBetween(80, 120));
        $templates = $this->templates->random($templatesCount);

        foreach ($templates as $template) {
            if ($template && isset($template->id)) {
                for ($j = 1; $j <= fake()->numberBetween(1, 3); $j++) {
                    $objective = new Objective();
                    $objective->template_id = $template->id;
                    $objective->name = $template->name . "[{$j}]";
                    $objective->description = '<p>' . fake()->text(fake()->numberBetween(150, 250)) . '</p>';
                    $objective->weight = fake()->randomFloat(2, 0.1, 1);
                    $objective->expected = fake()->numberBetween(1000, 5500);
                    $objective->award = fake()->randomFloat(2, 1, 100);
                    $objective->draft = 0;
                    $objective->save();

                    if ($objective->id) {
                        $tempUsersCount = min($this->users->count(), fake()->numberBetween(4, 10));
                        $tempUsers = $this->users->random($tempUsersCount);

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
        $coordinatorCount = min($this->users->count(), fake()->numberBetween(10, 20));
        $coordinatorUsers = $this->users->random($coordinatorCount);

        for ($i = 1; $i <= 50; $i++) {
            $campaign = Campaign::factory()->create([
                'name' => [
                    'pl' => 'Testowa kampania ' . $i,
                    'en' => 'Test campaign ' . $i,
                    'it' => 'Campagna di prova ' . $i,
                ],
            ]);

            $campaignTemplates = $this->templates->pop(fake()->numberBetween(2, 6));

            foreach ($campaignTemplates as $template) {
                if ($template && isset($template->id) && $campaign) {
                    for ($j = 1; $j <= fake()->numberBetween(1, 3); $j++) {
                        $objective = new Objective();
                        $objective->campaign_id = $campaign->id;
                        $objective->template_id = $template->id;
                        $objective->name = $template->name . "[{$j}]";
                        $objective->description = '<p>' . fake()->text(fake()->numberBetween(150, 250)) . '</p>';
                        $objective->weight = fake()->randomFloat(2, 0.1, 1);
                        $objective->expected = fake()->numberBetween(1000, 5500);
                        $objective->award = fake()->randomFloat(2, 1, 100);
                        $objective->draft = 0;
                        $objective->save();
                    }
                }
            }

            $tempUsersCount = min($this->users->count(), fake()->numberBetween(4, 10));
            $tempUsers = $this->users->random($tempUsersCount);
            foreach ($tempUsers as $user) {
                if ($user && isset($user->id)) {
                    $campaign->assignUser($user->id);
                }
            }

            $coordinatorsCount = min($coordinatorUsers->count(), fake()->numberBetween(1, 3));
            $coordinators = $coordinatorUsers->random($coordinatorsCount);
            $campaign->refreshCoordinators($coordinators->pluck('id')->toArray());
        }
    }
}
