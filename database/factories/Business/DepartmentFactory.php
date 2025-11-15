<?php

namespace Database\Factories\Business;

use App\Models\Business\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business\Company>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = null;
        while (is_null($title) || Department::where('name', $title)->get()->count() > 0) {
            $title = $this->getName();
        }
        return [
            'name' => $title,
            'description' => fake()->realTextBetween(300, 900),
        ];
    }

    public function getName(): string
    {
        $output = null;
        if (config('app.faker_locale') === 'pl_PL') {
            $dict = self::dict_pl();
            $output = $dict[fake()->numberBetween(0, count($dict) - 1)];
        }

        if (empty($output)) {
            $output = fake()->jobTitle();
        }

        return $output;
    }

    public static function dict_pl(): array
    {
        return [
            "Dział Administracji",
            "Dział Administracji Ogólnej",
            "Dział Administracji Biura",
            "Dział Administracyjno-Gospodarczy",
            "Dział Obsługi Biura",
            "Dział Organizacyjny",
            "Dział Sekretariatu",
            "Dział Zarządzania Dokumentacją",
            "Dział Archiwum",
            "Dział RODO",

            "Dział HR",
            "Dział Kadr",
            "Dział Płac",
            "Dział Kadr i Płac",
            "Dział Rekrutacji",
            "Dział Rozwoju Pracowników",
            "Dział Szkoleń",
            "Dział Employer Branding",
            "Dział HR Business Partnerów",
            "Dział Benefitów",

            "Dział Obsługi Klienta",
            "Dział Wsparcia Klienta",
            "Dział Reklamacji",
            "Dział Call Center",
            "Dział Client Service",
            "Dział Contact Center",
            "Dział Obsługi Klienta Biznesowego",
            "Dział Obsługi Kluczowych Klientów",
            "Dział Helpdesk",
            "Dział Wsparcia Technicznego",

            "Dział Sprzedaży",
            "Dział Sprzedaży B2B",
            "Dział Sprzedaży B2C",
            "Dział Sprzedaży Internetowej",
            "Dział Handlowy",
            "Dział Negocjacji",
            "Dział Rozwoju Biznesu",
            "Dział Obsługi Zamówień",
            "Dział Ofertowania",
            "Dział Przetargów",

            "Dział Finansowy",
            "Dział Księgowości",
            "Dział Rachunkowości",
            "Dział Podatków",
            "Dział Budżetowania",
            "Dział Kontrolingu",
            "Dział Rozliczeń",
            "Dział Windykacji",
            "Dział Wypłat",
            "Dział Należności",

            "Dział Marketingu",
            "Dział Social Media",
            "Dział PR",
            "Dział Komunikacji Wewnętrznej",
            "Dział Komunikacji Zewnętrznej",
            "Dział Digital Marketingu",
            "Dział Strategii Marketingowej",
            "Dział Reklamy",
            "Dział Contentu",
            "Dział Projektów Marketingowych",

            "Dział IT",
            "Dział Rozwoju IT",
            "Dział Utrzymania IT",
            "Dział Wsparcia IT",
            "Dział Administracji Systemów",
            "Dział Bezpieczeństwa IT",
            "Dział Sieci",
            "Dział Baz Danych",
            "Dział Testów",
            "Dział Helpdesk IT",

            "Dział Logistyki",
            "Dział Transportu",
            "Dział Planowania",
            "Dział Magazynowania",
            "Dział Spedycji",
            "Dział Łańcucha Dostaw",
            "Dział Zaopatrzenia",
            "Dział Ewidencji Towarów",
            "Dział Importu",
            "Dział Eksportu",

            "Dział Zakupów",
            "Dział Zamówień Publicznych",
            "Dział Negocjacji Zakupowych",
            "Dział Zarządzania Dostawcami",
            "Dział Sourcingu",
            "Dział Zakupów Strategicznych",
            "Dział Zakupów Operacyjnych",
            "Dział Planowania Dostaw",
            "Dział Zaopatrzenia Produkcji",
            "Dział Kontraktacji",

            "Dział Jakości",
            "Dział Kontroli Jakości",
            "Dział Audytu",
            "Dział Certyfikacji",
            "Dział BHP",
            "Dział Ochrony Środowiska",
            "Dział Compliance",
            "Dział Ryzyka",
            "Dział Regulacji",
            "Dział Procesów",

            "Dział Analiz",
            "Dział Analiz Biznesowych",
            "Dział Analiz Finansowych",
            "Dział Analiz Rynku",
            "Dział Analiz Operacyjnych",
            "Dział Analiz Sprzedaży",
            "Dział Danych",
            "Dział Business Intelligence",
            "Dział Automatyzacji",
            "Dział Strategii",

            "Dział Operacyjny",
            "Dział Operacji Biznesowych",
            "Dział Operacji Technicznych",
            "Dział Obsługi Operacyjnej",
            "Dział Optymalizacji Operacji",
            "Dział Usług Wewnętrznych",
            "Dział Koordynacji Operacyjnej",
            "Dział Zarządzania Procesami",
            "Dział Wsparcia Operacyjnego",
            "Dział Efektywności",

            "Dział Projektów",
            "Dział Zarządzania Projektami",
            "Dział PMO",
            "Dział Realizacji Projektów",
            "Dział Koordynacji Projektowej",
            "Dział Wsparcia Projektów",
            "Dział Analizy Projektów",
            "Dział Dokumentacji Projektowej",
            "Dział Portfela Projektów",
            "Dział Optymalizacji Projektów",

            "Dział Produkcji",
            "Dział Techniczny",
            "Dział Utrzymania Ruchu",
            "Dział Kontroli Produkcji",
            "Dział Planowania Produkcji",
            "Dział Inżynierii Produkcji",
            "Dział Zarządzania Procesem Produkcyjnym",
            "Dział Wsparcia Technicznego",
            "Dział Badań i Rozwoju",
            "Dział Innowacji",

            "Dział Prawny",
            "Dział Obsługi Prawnej",
            "Dział Zamówień Prawnych",
            "Dział Compliance Prawnego",
            "Dział Umów",
            "Dział Wsparcia Prawnego",
            "Dział Regulacji Prawnych",
            "Dział Nadzoru Prawnego",
            "Dział Prawa Pracy",
            "Dział Prawa Handlowego",

            "Dział Nieruchomości",
            "Dział Zarządzania Nieruchomościami",
            "Dział Administracji Budynków",
            "Dział Utrzymania Obiektów",
            "Dział Serwisu Technicznego",
            "Dział Infrastruktury",
            "Dział Energetyczny",
            "Dział Konserwacji",
            "Dział Plans & Maintenance",
            "Dział Sprzątania i Usług Wewnętrznych",

            "Dział Finansów Strategicznych",
            "Dział Planowania Strategicznego",
            "Dział Rozwoju Korporacyjnego",
            "Dział Współpracy Międzynarodowej",
            "Dział Partnerski",
            "Dział Programów Biznesowych",
            "Dział Zarządzania Zmianą",
            "Dział Optymalizacji Kosztów",
            "Dział Audytu Wewnętrznego",
            "Dział Raportowania",

            "Dział Obsługi Administracji Publicznej",
            "Dział Dokumentacji Prawnej",
            "Dział Wsparcia Formalnego",
            "Dział Rozliczeń Administracyjnych",
            "Dział Archiwizacji Dokumentów",
            "Dział Rejestracji Dokumentów",
            "Dział Zarządzania Informacją",
            "Dział Kontroli Dokumentów",
            "Dział Digitalizacji",
            "Dział Procesów Administracyjnych"
        ];
    }
}
