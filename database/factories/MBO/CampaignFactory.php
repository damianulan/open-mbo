<?php

namespace Database\Factories\MBO;

use App\Models\MBO\Campaign;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\ObjectiveTemplateCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MBO\ObjectiveTemplate>
 */
class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $datetime = fake()->dateTimeBetween('-3 weeks', '+2 months');
        $now = Carbon::parse($datetime);
        return [
            'period' => '2025 Q' . fake()->numberBetween(1, 4),
            'description' => '<p>' . fake()->text(fake()->numberBetween(500, 1000)) . '</p>',
            'definition_from' => $now->format('Y-m-d') . ' 00:00:00',
            'definition_to' => $now->addDays(3)->format('Y-m-d') . ' 23:59:59',
            'disposition_from' => $now->addDays(1)->format('Y-m-d') . ' 00:00:00',
            'disposition_to' => $now->addDays(5)->format('Y-m-d') . ' 23:59:59',
            'realization_from' => $now->addDays(1)->format('Y-m-d') . ' 00:00:00',
            'realization_to' => $now->addDays(fake()->numberBetween(1, 15))->format('Y-m-d') . ' 23:59:59',
            'evaluation_from' => $now->addDays(1)->format('Y-m-d') . ' 00:00:00',
            'evaluation_to' => $now->addDays(5)->format('Y-m-d') . ' 23:59:59',
            'self_evaluation_from' => $now->addDays(1)->format('Y-m-d') . ' 00:00:00',
            'self_evaluation_to' => $now->addDays(5)->format('Y-m-d') . ' 23:59:59',
            'draft' => 0,
            'manual' => 0,
        ];
    }

    public function draft()
    {
        return $this->state(fn (array $attributes) => [
            'draft' => 1,
        ]);
    }
}
