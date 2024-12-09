<?php

namespace Database\Factories\MBO;

use App\Models\MBO\Objective;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\ObjectiveTemplateCategory;
use App\Enums\MBO\ObjectiveType;

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
        if(isset($categories[$cat_num])){
            $category_shortname = $categories[$cat_num];
        }

        if($category_shortname){
            $category = ObjectiveTemplateCategory::findByShortname($category_shortname);
        }
        $objectiveTypes = ObjectiveType::values();
        $objectiveType = $objectiveTypes[fake()->numberBetween(0, count($objectiveTypes) - 1)];

        if($category){
            return [
                'category_id' => $category->id,
                'name' => trim('Cel '. fake()->text(25),'.'),
                'description' => fake()->paragraph(),
                'type' => $objectiveType,
                'draft' => 0,
                'award' => fake()->randomFloat(2, 1, 30),
            ];
        } else {
            throw new \Exception('No category found');
        }

    }

    public function draft()
    {
        return $this->state(fn (array $attributes) => [
            'draft' => 1,
        ]);
    }
}
