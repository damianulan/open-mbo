<?php

namespace App\Lib\Mbo\Bonus;

use Countable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class BonusSchemeOptions implements Arrayable, Countable, Jsonable, JsonSerializable
{
    public int $reward_modifier;

    public float $campaigns_bonus;

    public float $rewards_min_evaluation;

    public bool $failed_rewards;

    public bool $manipulate_rewards;

    public function __construct(array $attributes = [])
    {
        foreach ($this->defaults() as $key => $value) {
            if (isset($attributes[$key])) {
                $value = $attributes[$key];
            }
            $this->{$key} = $value;
        }
    }

    public static function make(array $attributes = []): static
    {
        return new static($attributes);
    }

    public static function fake(): static
    {
        return new static([
            'bonus' => 0.00,
            'rewards_min_evaluation' => fake()->randomFloat(2, 80, 100),
            'failed_rewards' => fake()->numberBetween(0, 1),
        ]);
    }

    public function defaults(): array
    {
        return [
            'reward_modifier' => 1,
            'campaigns_bonus' => settings('mbo.campaigns_bonus'),
            'rewards_min_evaluation' => settings('mbo.rewards_min_evaluation'),
            'failed_rewards' => settings('mbo.failed_rewards'),
            'manipulate_rewards' => settings('mbo.manipulate_rewards'),
        ];
    }

    public function rules(): array
    {
        return [];
    }

    public function validator(): void {}

    public function count(): int
    {
        return count($this->toArray());
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    public function jsonSerialize(): string
    {
        return $this->toJson();
    }
}
