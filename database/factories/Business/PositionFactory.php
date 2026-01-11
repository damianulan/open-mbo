<?php

namespace Database\Factories\Business;

use App\Models\Business\Position;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

class PositionFactory extends Factory
{
    public static function seedPositions(int $num = 10): void
    {
        $dict = self::dict_pl();
        $required = array(
            'CEO' => 'Chief Executive Officer',
            'CTO' => 'Chief Technology Officer',
            'CFO' => 'Chief Financial Officer',
        );

        foreach ($required as $name => $description) {
            Position::create(array(
                'name' => $name,
                'description' => $description,
            ));
        }

        for ($i = $num; $i > 0; $i--) {
            $d = $dict->pull($i);

            Position::create(array(
                'name' => $d,
            ));
        }
    }

    public static function dict_pl(): Collection
    {
        return Collection::make(array(
            'CEO',
            'CTO',
            'CFO',
            'Asystent biurowy',
            'Asystent administracyjny',
            'Asystent zarządu',
            'Asystent działu HR',
            'Asystent działu finansowego',
            'Asystent działu marketingu',
            'Asystent działu sprzedaży',
            'Asystent działu prawnego',
            'Asystent działu IT',
            'Asystent projektanta',
            'Asystent koordynatora projektów',
            'Asystent sekretariatu',
            'Asystent ds. logistyki',
            'Asystent ds. zakupów',
            'Asystent ds. obsługi klienta',
            'Asystent ds. administracji personalnej',
            'Asystent ds. księgowości',
            'Asystent ds. jakości',
            'Asystent ds. compliance',
            'Asystent ds. operacyjnych',

            'Sekretarka',
            'Sekretarka zarządu',
            'Sekretarka dyrektora',
            'Sekretarz biura',
            'Sekretarz administracyjny',

            'Recepcjonista',
            'Recepcjonistka medyczna',
            'Recepcjonista korporacyjny',

            'Office Manager',
            'Office Assistant',
            'Office Coordinator',
            'Office Administrator',
            'Office Supervisor',

            'Specjalista ds. administracji',
            'Specjalista ds. administracyjnych',
            'Specjalista ds. biurowych',
            'Specjalista ds. organizacyjnych',
            'Specjalista ds. obsługi biura',
            'Specjalista ds. dokumentacji',
            'Specjalista ds. archiwizacji',
            'Specjalista ds. zarządzania biurem',
            'Specjalista ds. ochrony danych osobowych',
            'Specjalista ds. RODO',

            'Koordynator biura',
            'Koordynator administracyjny',
            'Koordynator recepcji',
            'Koordynator ds. dokumentacji',
            'Koordynator ds. rozliczeń',
            'Koordynator ds. projektów',
            'Koordynator ds. biurowych',
            'Koordynator ds. zakupów',
            'Koordynator ds. HR',
            'Koordynator ds. marketingu',

            'Administrator biurowy',
            'Administrator systemów biurowych',
            'Administrator danych',
            'Administrator dokumentacji',
            'Administrator budynku',
            'Administrator zasobów',
            'Administrator projektu',
            'Administrator ERP',

            'Referent administracyjny',
            'Referent biurowy',
            'Referent ds. kadr',
            'Referent ds. płac',
            'Referent ds. finansowych',
            'Referent ds. zamówień',
            'Referent ds. logistyki',
            'Referent ds. marketingu',
            'Referent ds. BHP',
            'Referent ds. organizacyjnych',

            'Specjalista ds. kadr i płac',
            'Specjalista ds. kadr',
            'Specjalista ds. płac',
            'Specjalista ds. HR',
            'Specjalista ds. rekrutacji',
            'Specjalista ds. szkoleń',
            'Specjalista ds. employer branding',
            'Specjalista ds. benefitów pracowniczych',
            'Specjalista ds. rozwijania kompetencji',
            'Specjalista ds. miękkiego HR',

            'Specjalista ds. obsługi klienta',
            'Specjalista ds. wsparcia klienta',
            'Specjalista ds. reklamacji',
            'Specjalista ds. kontaktu z klientem',
            'Specjalista ds. infolinii',
            'Specjalista ds. helpdesk',
            'Specjalista ds. wsparcia technicznego',
            'Specjalista ds. klienta biznesowego',
            'Specjalista ds. klienta kluczowego',
            'Specjalista ds. call center',

            'Specjalista ds. sprzedaży',
            'Specjalista ds. sprzedaży B2B',
            'Specjalista ds. sprzedaży internetowej',
            'Specjalista ds. ofertowania',
            'Specjalista ds. przetargów',
            'Specjalista ds. negocjacji',
            'Specjalista ds. handlowych',
            'Specjalista ds. rozwoju biznesu',
            'Specjalista ds. partnerskich',
            'Specjalista ds. kontraktów',

            'Specjalista ds. księgowości',
            'Specjalista ds. rachunkowości',
            'Księgowy',
            'Młodszy księgowy',
            'Starszy księgowy',
            'Samodzielny księgowy',
            'Główny księgowy',
            'Analityk finansowy',
            'Kontroler finansowy',
            'Specjalista ds. budżetowania',

            'Specjalista ds. finansów',
            'Specjalista ds. analiz finansowych',
            'Specjalista ds. controllingu',
            'Specjalista ds. rozliczeń',
            'Specjalista ds. windykacji',
            'Specjalista ds. fakturowania',
            'Specjalista ds. podatków',
            'Specjalista ds. kosztów',
            'Specjalista ds. ubezpieczeń',
            'Specjalista ds. należności',

            'Specjalista ds. marketingu',
            'Specjalista ds. social media',
            'Specjalista ds. digital marketingu',
            'Specjalista ds. PR',
            'Specjalista ds. komunikacji wewnętrznej',
            'Specjalista ds. komunikacji zewnętrznej',
            'Copywriter',
            'Content Manager',
            'Graphic Designer',
            'Event Manager',

            'Specjalista ds. IT',
            'Specjalista ds. wsparcia IT',
            'Specjalista ds. systemów ERP',
            'Specjalista ds. bezpieczeństwa IT',
            'Specjalista ds. sieci komputerowych',
            'Specjalista ds. administracji systemów',
            'Specjalista ds. baz danych',
            'Specjalista ds. testów',
            'Helpdesk IT',
            'Administrator IT',

            'Specjalista ds. logistyki',
            'Specjalista ds. transportu',
            'Specjalista ds. planowania',
            'Specjalista ds. magazynowania',
            'Specjalista ds. spedycji',
            'Specjalista ds. łańcucha dostaw',
            'Specjalista ds. ewidencji towarów',
            'Specjalista ds. zaopatrzenia',
            'Specjalista ds. eksportu',
            'Specjalista ds. importu',

            'Specjalista ds. zakupów',
            'Specjalista ds. zamówień publicznych',
            'Specjalista ds. negocjacji zakupowych',
            'Specjalista ds. dostawców',
            'Specjalista ds. sourcingu',
            'Kupiec',
            'Kupiec strategiczny',
            'Kupiec operacyjny',
            'Planista dostaw',
            'Planista produkcji',

            'Specjalista ds. jakości',
            'Specjalista ds. audytu',
            'Specjalista ds. kontroli jakości',
            'Specjalista ds. certyfikacji',
            'Specjalista ds. BHP',
            'Specjalista ds. ochrony środowiska',
            'Specjalista ds. compliance',
            'Specjalista ds. ryzyka',
            'Specjalista ds. regulacji',
            'Specjalista ds. procesów',

            'Analityk biznesowy',
            'Analityk danych',
            'Analityk procesów',
            'Analityk sprzedaży',
            'Analityk rynku',
            'Analityk systemowy',
            'Analityk HR',
            'Analityk finansowy junior',
            'Analityk dokumentacji',
            'Analityk operacyjny',

            'Pracownik biurowy',
            'Pracownik administracyjny',
            'Pracownik sekretariatu',
            'Pracownik działu kadr',
            'Pracownik działu finansów',
            'Pracownik działu marketingu',
            'Pracownik działu IT',
            'Pracownik działu zakupów',
            'Pracownik działu logistyki',
            'Pracownik działu obsługi klienta',

            'Menedżer biura',
            'Menedżer administracyjny',
            'Menedżer ds. operacyjnych',
            'Menedżer ds. HR',
            'Menedżer ds. marketingu',
            'Menedżer ds. sprzedaży',
            'Menedżer ds. zakupów',
            'Menedżer ds. finansów',
            'Menedżer projektów',
            'Menedżer floty',

            'Doradca klienta',
            'Doradca klienta biznesowego',
            'Doradca ds. finansowych',
            'Doradca ds. technicznych',
            'Doradca ds. administracji',
            'Doradca ds. marketingu',
            'Doradca podatkowy',
            'Doradca personalny',
            'Doradca HR',
            'Doradca ds. nieruchomości',

            'Koordynator szkoleń',
            'Koordynator eventów',
            'Koordynator komunikacji',
            'Koordynator relacji z klientem',
            'Koordynator zasobów ludzkich',
            'Koordynator dokumentów przetargowych',
            'Koordynator procesów',
            'Koordynator operacyjny',
            'Koordynator sprzedaży',
            'Koordynator zespołu',

            'Archiwista',
            'Archiwista dokumentów',
            'Archiwista cyfrowy',
            'Dokumentalista',
            'Specjalista ds. archiwum',
            'Specjalista ds. digitalizacji',
            'Kontroler dokumentacji',
            'Rejestrator dokumentów',
            'Operator wprowadzania danych',
            'Weryfikator danych',
        ));
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = null;
        while (is_null($title) || Position::where('name', $title)->get()->count() > 0) {
            $title = $this->jobTitle();
        }

        return array(
            'name' => $title,
            'description' => fake()->realTextBetween(300, 900),
        );
    }

    public function jobTitle(): string
    {
        $output = null;
        if ('pl_PL' === config('app.faker_locale')) {
            $dict = self::dict_pl();
            $output = $dict[fake()->numberBetween(0, count($dict) - 1)];
        }

        if (empty($output)) {
            $output = fake()->jobTitle();
        }

        return mb_ucfirst($output);
    }
}
