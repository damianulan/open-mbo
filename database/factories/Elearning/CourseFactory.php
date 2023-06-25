<?php

namespace Database\Factories\Elearning;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Elearning\CourseCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = CourseCategory::inRandomOrder()->first();
        return [
            'category_id' => $category->id,
            'title' => $this->fakeDictionary('course_titles'),
            'description' => fake()->text(),
            'available_from' => fake()->dateTimeThisYear(),
            'public' => fake()->boolean(),
            'active' => true,
            'visible' => true,
        ];
    }

    private function fakeDictionary(string $dictionary): string
    {
        $dict = self::$dictionary();
        $max = count($dict) - 1;
        return $dict[rand(0, $max)];
    }

    private static function course_titles(): array
    {
        return [
            "Tworzenie stron internetowych dla początkujących",
            "Marketing internetowy 101",
            "Wprowadzenie do programowania w Pythonie",
            "Projektowanie graficzne dla amatorów",
            "Analiza danych w języku R",
            "Tworzenie aplikacji mobilnych na platformę Android",
            "Fotografia cyfrowa dla początkujących",
            "Wprowadzenie do sztucznej inteligencji",
            "Kurs Excel dla zaawansowanych",
            "Tworzenie animacji 3D w Blenderze",
            "Wprowadzenie do e-commerce",
            "Pisanie kreatywnych opowiadań",
            "Zarządzanie projektami w Agile",
            "Wprowadzenie do sztuki cyfrowej",
            "Tworzenie gier w Unity",
            "Język niemiecki dla początkujących",
            "Kurs budowy robotów dla dzieci",
            "Wprowadzenie do analizy rynku finansowego",
            "Tworzenie podcastów dla początkujących",
            "Kurs języka migowego",
            "Wprowadzenie do sieci neuronowych",
            "Kurs biznesu online dla przedsiębiorców",
            "Wprowadzenie do projektowania wnętrz",
            "Kurs pierwszej pomocy",
            "Wprowadzenie do sztuki ulicznej",
            "Programowanie gier w C++",
            "Kurs psychologii pozytywnej",
            "Tworzenie własnego bloga",
            "Wprowadzenie do rozwoju osobistego",
            "Kurs gotowania wegetariańskiego",
            "Socjal media marketing dla firm",
            "Wprowadzenie do analizy danych w Excelu",
            "Kurs języka hiszpańskiego online",
            "Rozwijanie umiejętności interpersonalnych",
            "Tworzenie interfejsów użytkownika",
            "Kurs projektowania logo",
            "Wprowadzenie do analizy rynku nieruchomości",
            "Kurs programowania w JavaScript",
            "Podstawy rachunkowości dla przedsiębiorców",
            "Wprowadzenie do sztuki kreatywnej",
            "Kurs negocjacji biznesowych",
            "Tworzenie stron internetowych responsywnych",
            "Wprowadzenie do fotografii krajobrazowej",
            "Kurs języka francuskiego dla początkujących",
            "Budowanie marki osobistej",
            "Wprowadzenie do copywritingu",
            "Kurs tworzenia prezentacji efektywnych",
            "Wprowadzenie do programowania w Java",
            "Kurs kryptowalut i technologii blockchain",
            "Tworzenie sklepów internetowych w WooCommerce",
            "Wprowadzenie do projektowania graficznego",
            "Kurs zarządzania czasem i produktywności",
            "Kurs gry na gitarze dla początkujących"
        ];
    }
}
