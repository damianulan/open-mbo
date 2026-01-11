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

    public function __construct(array $attributes = array())
    {
        foreach ($this->defaults() as $key => $value) {
            if (isset($attributes[$key])) {
                $value = $attributes[$key];
            }
            $this->{$key} = $value;
        }
    }

    public static function make(array $attributes = array()): static
    {
        return new static($attributes);
    }

    public static function fake(): static
    {
        return new static(array(
            'bonus' => 0.00,
            'rewards_min_evaluation' => fake()->randomFloat(2, 80, 100),
            'failed_rewards' => fake()->numberBetween(0, 1),
        ));
    }

    public function defaults(): array
    {
        return array(
            'reward_modifier' => 1,
            'campaigns_bonus' => settings('mbo.campaigns_bonus'),
            'rewards_min_evaluation' => settings('mbo.rewards_min_evaluation'),
            'failed_rewards' => settings('mbo.failed_rewards'),
            'manipulate_rewards' => settings('mbo.manipulate_rewards'),
        );
    }

    public function rules(): array
    {
        return array();
    }

    public function validator(): void {}

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
