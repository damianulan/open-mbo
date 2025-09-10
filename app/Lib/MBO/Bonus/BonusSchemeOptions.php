<?php

namespace App\Lib\MBO\Bonus;

use Countable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class BonusSchemeOptions implements Arrayable, Countable, Jsonable, JsonSerializable
{
    public $reward_modifier;

    public $campaigns_bonus;

    public $rewards_min_evaluation;

    public $failed_rewards;

    public $manipulate_rewards;

    public function __construct(array $attributes = [])
    {
        foreach ($this->defaults() as $key => $value) {
            if (isset($attributes[$key])) {
                $value = $attributes[$key];
            }
            $this->$key = $value;
        }
    }

    public function defaults(): array
    {
        return [
            'reward_modifier' => 1,
            'campaigns_bonus' => settings('mbo.campaigns_bonus'),
            'reward_rewards_min_evaluation' => settings('mbo.rewards_min_evaluation'),
            'failed_rewards' => settings('mbo.failed_rewards'),
            'manipulate_rewards' => settings('mbo.manipulate_rewards'),
        ];
    }

    public function rules(): array
    {
        return [];
    }

    public function validator() {}

    public static function make(array $attributes = []): static
    {
        return new static($attributes);
    }

    public static function fake(): static
    {
        return new static([
            'bonus' => 0.00,
            'reward_rewards_min_evaluation' => fake()->randomFloat(2, 80, 100),
            'failed_rewards' => fake()->randomNumberBetween(0, 1),
        ]);
    }

    public function count(): int
    {
        return count($this->toArray());
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function jsonSerialize(): mixed
    {
        return $this->toJson();
    }
}
