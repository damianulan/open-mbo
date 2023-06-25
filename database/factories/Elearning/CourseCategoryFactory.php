<?php

namespace Database\Factories\Elearning;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->fakeDictionary('category_titles'),
            'description' => fake()->text(),
            'public' => fake()->boolean(),
            'visible' => true,
        ];
    }

    private function fakeDictionary(string $dictionary): string
    {
        $dict = self::$dictionary();
        $max = count($dict) - 1;
        return $dict[rand(0, $max)];
    }

    private static function category_titles(): array
    {
        return [
            "Programowanie",
            "Marketing",
            "Grafika i design",
            "Analiza danych",
            "Aplikacje mobilne",
            "Fotografia",
            "Sztuczna inteligencja",
            "Biznes i finanse",
            "Języki obce",
            "Robotyka",
            "Sztuka cyfrowa",
            "Gry komputerowe",
            "Kursy językowe",
            "E-commerce",
            "Pisanie i redakcja",
            "Zarządzanie projektami",
            "Programowanie webowe",
            "Nauka online",
            "Rozwój osobisty",
            "Psychologia",
            "Tworzenie treści",
            "Sieci neuronowe",
            "Informatyka",
            "Projektowanie wnętrz",
            "Kursy pierwszej pomocy",
            "Sztuka uliczna",
            "Język migowy",
            "Socjal media",
            "Analiza finansowa",
            "Podcasty",
            "Sztuka i kultura",
            "Kursy muzyczne",
            "Copywriting",
            "Kreatywne rozwiązania",
            "Prezentacje i wystąpienia publiczne",
            "Kryptowaluty",
            "Tworzenie sklepów internetowych",
            "Grafika komputerowa",
            "Zarządzanie czasem",
            "Kursy zdrowotne",
            "Nauka języków obcych",
            "Gitarowe rytmy",
            "Tworzenie stron internetowych",
            "Marketing internetowy",
            "Projektowanie logo",
            "Analiza rynku",
            "Tworzenie aplikacji",
            "Grafika komputerowa",
            "Szkolenia HR",
            "Podstawy biznesu",
            "Tworzenie wideo"
        ];
    }
}
