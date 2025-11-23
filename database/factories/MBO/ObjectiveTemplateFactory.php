<?php

namespace Database\Factories\MBO;

use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\ObjectiveTemplateCategory;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MBO\ObjectiveTemplate>
 */
class ObjectiveTemplateFactory extends Factory
{
    protected $model = ObjectiveTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ObjectiveTemplateCategory::baseCategories();
        $cat_num = fake()->numberBetween(0, count($categories) - 1);
        $category_shortname = null;
        $category = null;
        if (isset($categories[$cat_num])) {
            $category_shortname = $categories[$cat_num];
        }

        if ($category_shortname) {
            $category = ObjectiveTemplateCategory::findByShortname($category_shortname);
        }

        if ($category) {
            return [
                'category_id' => $category->id,
                'name' => trim(fake()->realTextBetween(10, 50), '.'),
                'description' => fake()->realTextBetween(300, 900),
                'draft' => 0,
                'award' => fake()->randomFloat(2, 1, 30),
            ];
        }
        throw new Exception('No category found');
    }

    public function draft()
    {
        return $this->state(fn (array $attributes) => [
            'draft' => 1,
        ]);
    }
}
