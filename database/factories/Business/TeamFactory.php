<?php

namespace Database\Factories\Business;

use App\Models\Business\Team;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Team>
 */
class TeamFactory extends Factory
{
    protected $model = Team::class;

    public static function dict_pl(): array
    {
        return [
            'Zespół Administracji',
            'Zespół HR',
            'Zespół IT',
            'Zespół Marketingu',
            'Zespół Obsługi Klienta',
            'Zespół Sprzedaży',
            'Zespół Finansów',
            'Zespół Produktu',
            'Zespół Projektowy',
            'Zespół Operacyjny',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->getName();

        return [
            'leader_id' => null,
            'name' => $name,
            'description' => fake()->realTextBetween(300, 900),
        ];
    }

    public function withLeader(?User $leader = null): static
    {
        return $this->state(fn (): array => [
            'leader_id' => $leader?->id ?? User::factory(),
        ]);
    }

    public function getName(): string
    {
        if (config('app.faker_locale') === 'pl_PL') {
            $dict = self::dict_pl();

            return $dict[fake()->numberBetween(0, count($dict) - 1)];
        }

        return Str::title(fake()->words(2, true));
    }
}
