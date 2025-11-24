<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Forms extends Seeder
{
    public static function list(): array
    {
        return [
            'generic.password' => [
                'pl' => 'Hasło',
            ],
            'generic.login' => [
                'pl' => 'Login',
            ],
            'generic.email' => [
                'pl' => 'E-mail',
            ],
            'version.stable' => [
                'pl' => 'Najnowsza stabilna wersja',
            ],
            'version.non-stable' => [
                'pl' => 'Najnowsza wersja testowa',
            ],
            'version.dev' => [
                'pl' => 'Najnowsza wersja deweloperska',
            ],
            'settings.mbo.index' => [
                'pl' => 'Moduł MBO',
            ],
            'settings.modules' => [
                'pl' => 'Zarządanie ustawieniami modułów',
            ],
            'settings.general.site_name' => [
                'pl' => 'Nazwa witryny',
            ],
            'settings.general.general' => [
                'pl' => 'Ogólne',
            ],
            'settings.general.theme' => [
                'pl' => 'Szablon',
            ],
            'settings.general.lang' => [
                'pl' => 'Język aplikacji',
            ],
            'settings.general.release' => [
                'pl' => 'Wersja aplikacji',
            ],
            'settings.server.mail_host' => [
                'pl' => 'Adres serwera',
            ],
            'settings.server.mail_port' => [
                'pl' => 'Port',
            ],
            'settings.server.mail_username' => [
                'pl' => 'Użytkownik',
            ],
            'settings.server.mail_encryption' => [
                'pl' => 'Metoda szyfrowania',
            ],
            'settings.server.mail_from_address' => [
                'pl' => 'Wysyłaj z adresu',
            ],
            'settings.server.mail_from_name' => [
                'pl' => 'Wysyłaj jako (nazwa)',
            ],
            'settings.server.mail_catchall_enabled' => [
                'pl' => 'Przekierowywanie wiadomości',
            ],
            'settings.server.mail_catchall_receiver' => [
                'pl' => 'Przekieruj na adres',
            ],
            'settings.mbo.enabled' => [
                'pl' => 'Moduł MBO włączony',
            ],
            'settings.mbo.campaigns_enabled' => [
                'pl' => 'Kampanie pomiarowe',
            ],
            'settings.mbo.campaigns_ignore_dates' => [
                'pl' => 'Zezwalaj na akcje po upływie terminu etapu',
            ],
            'settings.mbo.objectives_self_final_evaluation' => [
                'pl' => 'Zezwalaj administratorom na samodzielnie ocenianie swoich celów',
            ],
            'settings.mbo.objectives_weights' => [
                'pl' => 'Wagi celów',
            ],
            'settings.mbo.campaigns_manual' => [
                'pl' => 'Tryb ręczny w kampaniach',
            ],
            'settings.mbo.campaigns_bonus' => [
                'pl' => 'Bonus dla kampanii [%]',
            ],
            'settings.mbo.objectives_autofail' => [
                'pl' => 'Automatyczne oznaczanie przedawnionych celów jako niezaliczone',
            ],
            'settings.mbo.rewards' => [
                'pl' => 'Punkty nagrody',
            ],
            'settings.mbo.rewards_proportional' => [
                'pl' => 'Przeliczaj punkty nagrody proporcjonalnie do rozliczenia',
            ],
            'settings.mbo.manipulate_rewards' => [
                'pl' => 'Możliwość edycji przeliczonych punktów nagrody',
            ],
            'settings.mbo.failed_rewards' => [
                'pl' => 'Przyznawaj punkty nagrody dla niezaliczonych celów',
            ],
            'settings.mbo.rewards_min_evaluation' => [
                'pl' => 'Minimalny wynik oceny celu',
            ],
            'settings.mbo.rewards_points_exchange' => [
                'pl' => 'Przeliczanie punktów nagrody',
            ],
            'settings.mbo.rewards_currency' => [
                'pl' => 'Waluta nagrody',
            ],
            'settings.mbo.info.enabled' => [
                'pl' => 'Włącza moduł MBO',
            ],
            'settings.mbo.info.campaigns_enabled' => [
                'pl' => 'Włącza kampanie pomiarowe',
            ],
            'settings.mbo.info.campaigns_bonus' => [
                'pl' => 'Przyznawaj dodatkowy bonus do punktów nagrody dla użytkowników, którzy osiągnęli wszystkie cele w kampanii. Wartość procentowa określona w tym polu odnosić się bedzię do sumy punktów nagrody uzyskanych ze wszystkich celów w kampanii.',
            ],
            'settings.mbo.info.campaigns_ignore_dates' => [
                'pl' => 'Każdy etap kampanii wymaga wykonania określonych akcji w terminach określonych przez Administratora. Zaznaczenie tej opcji zezwala na wykonywania akcji po upływie tych terminów.',
            ],
            'settings.mbo.info.campaigns_manual' => [
                'pl' => 'Włącza tryb ręczny w kampaniach',
            ],
            'settings.mbo.info.objectives_autofail' => [
                'pl' => 'Automatyczne oznaczanie celów określonych terminem wykonania jako niezaliczonych po upływie terminu, jeśli nie wprowadzono wyników realizacji.',
            ],
            'settings.mbo.info.manipulate_rewards' => [
                'pl' => 'Administratorzy mają możliwość edycji przeliczonych proporcjonalnie punktów nagrody, po ich rozliczeniu.',
            ],
            'settings.mbo.info.objectives_weights' => [
                'pl' => 'Jeśli wagi celów są wyłączone, każdy cel ma domyślnie wagę = 1.',
            ],
            'settings.mbo.info.rewards' => [
                'pl' => 'Włącza punkty nagrody',
            ],
            'settings.mbo.info.rewards_proportional' => [
                'pl' => 'Przeliczaj punkty nagrody proporcjonalnie do wyniku realizacji celu.',
            ],
            'settings.mbo.info.failed_rewards' => [
                'pl' => 'Mimo oznaczenia celu jako niezaliczony, przyznaj punkty nagrody proporcjonalnie do wyniku realizacji celu.',
            ],
            'settings.mbo.info.rewards_min_evaluation' => [
                'pl' => 'Minimalny wynik procentowy potrzebny do otrzymania punktów nagrody. Punkty nagrody będą przeliczane proporcjonalnie powyżej zadeklarowanej wartości. Aby wyłączyć tę funkcję, ustaw wartość na 0.',
            ],
            'settings.mbo.info.rewards_points_exchange' => [
                'pl' => 'Stosunek jednego punktu nagrody do jednego punktu w wybranej walucie',
            ],
            'settings.mbo.info.rewards_currency' => [
                'pl' => 'Waluta przyznawania nagrody',
            ],
            'settings.users.multiple_employments' => [
                'pl' => 'Wielozatrudnienie',
            ],
            'settings.users.info.multiple_employments' => [
                'pl' => 'Zezwalaj na dodawanie wielu aktywnych zatrudnień dla pojedynczego profilu.',
            ],
            'settings.users.password_change_firstlogin' => [
                'pl' => 'Wymuszaj zmianę hasła',
            ],
            'settings.users.info.password_change_firstlogin' => [
                'pl' => 'Wymuszaj zmianę hasła po pierwszym logowaniu',
            ],
            'settings.notifications.mail_notifications' => [
                'pl' => 'Wysyłanie powiadomień e-mail',
            ],
            'settings.notifications.info.mail_notifications' => [
                'pl' => 'Wyłączona funkcja oznacza zablokowanie wszelkiej wysyłki powiadomień e-mail, niezależnie od preferencji użytkowników. Nie dotyczy podstawowych funkcjonalności systemu - np. reset hasła, email powitalny itp.',
            ],
            'settings.notifications.system_notifications' => [
                'pl' => 'Wysyłanie powiadomień w systemie',
            ],
            'settings.notifications.info.system_notifications' => [
                'pl' => 'Wyłączona funkcja oznacza zablokowanie wszelkiej wysyłki powiadomień w systemie (ikona dzwonka w górnym menu), niezależnie od preferencji użytkowników.',
            ],
            'placeholders.choose' => [
                'pl' => 'Wybierz...',
            ],
            'placeholders.choose_date' => [
                'pl' => 'Wybierz datę',
            ],
            'placeholders.choose_birthdate' => [
                'pl' => 'Wybierz datę',
            ],
            'placeholders.choose_time' => [
                'pl' => 'Wybierz godzinę',
            ],
            'placeholders.choose_datetime' => [
                'pl' => 'Wybierz datę oraz godzinę',
            ],
            'placeholders.choose_daterange_from' => [
                'pl' => 'Wybierz datę od...',
            ],
            'placeholders.choose_daterange_to' => [
                'pl' => 'Wybierz datę do...',
            ],
            'from' => [
                'pl' => '[OD]',
            ],
            'to' => [
                'pl' => '[DO]',
            ],
            'campaigns.name' => [
                'pl' => 'Nazwa kampanii',
            ],
            'campaigns.period' => [
                'pl' => 'Okres pomiaru',
            ],
            'campaigns.description' => [
                'pl' => 'Opis',
            ],
            'campaigns.date_start' => [
                'pl' => 'Data rozpoczęcia pomiaru',
            ],
            'campaigns.date_end' => [
                'pl' => 'Data zakończenia pomiaru',
            ],
            'campaigns.stages.definition' => [
                'pl' => 'Tworzenie strategii i określanie celów',
            ],
            'campaigns.stages.disposition' => [
                'pl' => 'Dysponowanie celów przez kierowników zespołów',
            ],
            'campaigns.stages.realization' => [
                'pl' => 'Realizacja celów',
            ],
            'campaigns.stages.evaluation' => [
                'pl' => 'Ewaluacja celów i ocena pracowników przez kierowników',
            ],
            'campaigns.stages.self_evaluation' => [
                'pl' => 'Samoocena pracowników',
            ],
            'campaigns.stages.completed' => [
                'pl' => 'Ocena zakończona',
            ],
            'campaigns.stages.terminated' => [
                'pl' => 'Kampania przerwana',
            ],
            'campaigns.stages.canceled' => [
                'pl' => 'Kampania odwołana',
            ],
            'campaigns.stages.in_progress' => [
                'pl' => 'Kampania w toku',
            ],
            'campaigns.stages.pending' => [
                'pl' => 'Oczekuje na rozpoczęcie pomiaru',
            ],
            'campaigns.info.period' => [
                'pl' => 'Wprowadź unikalny reprezentatywny okres pomiaru, np. dla pomiaru co kwartał: 2023 Q3.',
            ],
            'campaigns.info.definition' => [
                'pl' => 'Tworzenie strategii i określanie celów',
            ],
            'campaigns.info.disposition' => [
                'pl' => 'Dysponowanie celów przez kierowników zespołów',
            ],
            'campaigns.info.realization' => [
                'pl' => 'Realizacja celów',
            ],
            'campaigns.info.evaluation' => [
                'pl' => 'Ewaluacja celów i ocena pracowników przez kierowników',
            ],
            'campaigns.info.self_evaluation' => [
                'pl' => 'Samoocena pracowników',
            ],
            'campaigns.info.completed' => [
                'pl' => 'Ocena zakończona',
            ],
            'campaigns.info.terminated' => [
                'pl' => 'Kampania przerwana',
            ],
            'campaigns.info.canceled' => [
                'pl' => 'Kampania odwołana',
            ],
            'campaigns.info.in_progress' => [
                'pl' => 'Kampania w toku',
            ],
            'campaigns.info.pending' => [
                'pl' => 'Oczekuje na rozpoczęcie pomiaru',
            ],
            'campaigns.info.draft' => [
                'pl' => 'Kampania będzie widoczna tylko dla administratorów i nie zostanie uruchomiona automatycznie.',
            ],
            'campaigns.info.manual' => [
                'pl' => 'Przejście pomiędzy etapami nie będzie uzależnione od dat, a od podjęcia akcji przez administratora. Opcję tą można także włączyć w trakcie trwania kampanii.',
            ],
            'campaigns.coordinators' => [
                'pl' => 'Koordynatorzy kampanii',
            ],
            'campaigns.draft' => [
                'pl' => 'Przechowuj jako wersję roboczą',
            ],
            'campaigns.manual' => [
                'pl' => 'Tryb ręczny',
            ],
            'campaigns.users.add' => [
                'pl' => 'Dodaj użytkowników',
            ],
            'users.header' => [
                'pl' => 'Dane użytkownika',
            ],
            'users.avatar' => [
                'pl' => 'Zdjęcie profilowe',
            ],
            'users.firstname' => [
                'pl' => 'Imię',
            ],
            'users.lastname' => [
                'pl' => 'Nazwisko',
            ],
            'users.email' => [
                'pl' => 'E-mail',
            ],
            'users.gender' => [
                'pl' => 'Płeć',
            ],
            'users.birthday' => [
                'pl' => 'Data urodzenia',
            ],
            'users.supervisors' => [
                'pl' => 'Bezpośredni przełożeni',
            ],
            'users.roles' => [
                'pl' => 'Role systemowe',
            ],
            'users.roles_short' => [
                'pl' => 'Role',
            ],
            'employments.index' => [
                'pl' => 'Zatrudnienia',
            ],
            'employments.add' => [
                'pl' => 'Dodaj nowe zatrudnienie',
            ],
            'employments.header' => [
                'pl' => 'Zatrudnienie #:no',
            ],
            'employments.header_main' => [
                'pl' => 'Zatrudnienie podstawowe',
            ],
            'employments.company' => [
                'pl' => 'Przedsiębiorstwo',
            ],
            'employments.position' => [
                'pl' => 'Stanowisko',
            ],
            'employments.contract' => [
                'pl' => 'Typ umowy',
            ],
            'employments.department' => [
                'pl' => 'Dział',
            ],
            'employments.employment' => [
                'pl' => 'Data zatrudnienia',
            ],
            'employments.release' => [
                'pl' => 'Data końca zatrudnienia',
            ],
            'mbo.objectives.category' => [
                'pl' => 'Kategoria',
            ],
            'mbo.objectives.template' => [
                'pl' => 'Szablon celu',
            ],
            'mbo.objectives.name' => [
                'pl' => 'Nazwa celu',
            ],
            'mbo.objectives.description' => [
                'pl' => 'Opis celu',
            ],
            'mbo.objectives.draft' => [
                'pl' => 'Wersja robocza',
            ],
            'mbo.objectives.deadline' => [
                'pl' => 'Termin realizacji',
            ],
            'mbo.objectives.deadline_to' => [
                'pl' => 'Termin realizacji :term',
            ],
            'mbo.objectives.weight' => [
                'pl' => 'Waga celu',
            ],
            'mbo.objectives.status' => [
                'pl' => 'Status celu',
            ],
            'mbo.objectives.type' => [
                'pl' => 'Typ celu',
            ],
            'mbo.objectives.expected' => [
                'pl' => 'Oczekiwany wynik',
            ],
            'mbo.objectives.award' => [
                'pl' => 'Punkty nagrody',
            ],
            'mbo.objectives.evaluation' => [
                'pl' => 'Aktualna realizacja celu',
            ],
            'mbo.objectives.users.add' => [
                'pl' => 'Dodaj użytkowników',
            ],
            'mbo.objectives.users.realization' => [
                'pl' => 'Obecna realizacja celu',
            ],
            'mbo.objectives.users.evaluation' => [
                'pl' => 'Wartość rozliczenia celu [%]',
            ],
            'mbo.objectives.users.info.realization' => [
                'pl' => 'Wskaż numeryczną wartość realizacji celu. Jeśli przy tworzeniu celu podano oczekwiany wynik, wartość rozliczenia celu zostanie wyliczona automatycznie.',
            ],
            'mbo.objectives.users.info.evaluation' => [
                'pl' => 'Wskaż wartość procentową realizacji celu. Jeśli przy tworzeniu celu podano oczekwiany wynik, wartość tego rozliczenia celu zostanie wyliczona automatycznie.',
            ],
            'mbo.objectives.info.deadline' => [
                'pl' => 'Po upłynięciu tej daty, cel przypisany do użytkownika zostanie automatycznie oznaczony jako zaliczony lub niezaliczony.',
            ],
            'mbo.objectives.info.weight' => [
                'pl' => 'Określ jaki wagowy udział ma ten cel w całej kampanii.',
            ],
            'mbo.objectives.info.expected' => [
                'pl' => 'Określ minimalny wynik potrzebny do zaliczenia celu. W razie nieosiągnięcia wyniku, Administratorzy nadal będą mogli wymusić zaliczenie celu.',
            ],
            'mbo.objectives.info.award' => [
                'pl' => 'W razie zaliczenia celu, na konto użytkownika wpadną określone tutaj punkty.',
            ],
            'mbo.objectives.info.draft' => [
                'pl' => 'Cel w wersji roboczej nie zostanie udostępniony do realizacji, jest także wyłączony z raportowania.',
            ],
            'mbo.categories.name' => [
                'pl' => 'Nazwa kategorii',
            ],
            'mbo.categories.template_count' => [
                'pl' => 'Powiązane szablony',
            ],
            'mbo.categories.shortname' => [
                'pl' => 'Unikalny identyfikator kategorii',
            ],
            'mbo.categories.description' => [
                'pl' => 'Opis kategorii',
            ],
            'mbo.categories.coordinators' => [
                'pl' => 'Koordynatorzy kategorii',
            ],
        ];
    }
}
