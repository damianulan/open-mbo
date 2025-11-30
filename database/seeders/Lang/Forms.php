<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Forms extends Seeder
{
    public static function list(): array
    {
        return array(
            'generic.password' => array(
                'pl' => 'Hasło',
            ),
            'generic.login' => array(
                'pl' => 'Login',
            ),
            'generic.email' => array(
                'pl' => 'E-mail',
            ),
            'version.stable' => array(
                'pl' => 'Najnowsza stabilna wersja',
            ),
            'version.non-stable' => array(
                'pl' => 'Najnowsza wersja testowa',
            ),
            'version.dev' => array(
                'pl' => 'Najnowsza wersja deweloperska',
            ),
            'settings.mbo.index' => array(
                'pl' => 'Moduł MBO',
            ),
            'settings.modules' => array(
                'pl' => 'Zarządanie ustawieniami modułów',
            ),
            'settings.general.site_name' => array(
                'pl' => 'Nazwa witryny',
            ),
            'settings.general.general' => array(
                'pl' => 'Ogólne',
            ),
            'settings.general.datas' => array(
                'pl' => 'Zarządzanie danymi w systemie',
            ),
            'settings.general.export_types' => array(
                'pl' => 'Rodzaje eksportu danych dostępne na platformie',
            ),
            'settings.general.theme' => array(
                'pl' => 'Szablon',
            ),
            'settings.general.site_logo' => array(
                'pl' => 'Logo platformy',
            ),
            'settings.general.lang' => array(
                'pl' => 'Język aplikacji',
            ),
            'settings.general.release' => array(
                'pl' => 'Wersja aplikacji',
            ),
            'settings.server.mail_host' => array(
                'pl' => 'Adres serwera',
            ),
            'settings.server.mail_port' => array(
                'pl' => 'Port',
            ),
            'settings.server.mail_username' => array(
                'pl' => 'Użytkownik',
            ),
            'settings.server.mail_encryption' => array(
                'pl' => 'Metoda szyfrowania',
            ),
            'settings.server.mail_from_address' => array(
                'pl' => 'Wysyłaj z adresu',
            ),
            'settings.server.mail_from_name' => array(
                'pl' => 'Wysyłaj jako (nazwa)',
            ),
            'settings.server.mail_catchall_enabled' => array(
                'pl' => 'Przekierowywanie wiadomości',
            ),
            'settings.server.mail_catchall_receiver' => array(
                'pl' => 'Przekieruj na adres',
            ),
            'settings.mbo.enabled' => array(
                'pl' => 'Moduł MBO włączony',
            ),
            'settings.mbo.campaigns_enabled' => array(
                'pl' => 'Kampanie pomiarowe',
            ),
            'settings.mbo.campaigns_ignore_dates' => array(
                'pl' => 'Zezwalaj na akcje po upływie terminu etapu',
            ),
            'settings.mbo.objectives_self_final_evaluation' => array(
                'pl' => 'Zezwalaj administratorom na samodzielnie ocenianie swoich celów',
            ),
            'settings.mbo.objectives_weights' => array(
                'pl' => 'Wagi celów',
            ),
            'settings.mbo.campaigns_manual' => array(
                'pl' => 'Tryb ręczny w kampaniach',
            ),
            'settings.mbo.campaigns_bonus' => array(
                'pl' => 'Bonus dla kampanii [%]',
            ),
            'settings.mbo.objectives_autofail' => array(
                'pl' => 'Automatyczne oznaczanie przedawnionych celów jako niezaliczone',
            ),
            'settings.mbo.rewards' => array(
                'pl' => 'Punkty nagrody',
            ),
            'settings.mbo.rewards_proportional' => array(
                'pl' => 'Przeliczaj punkty nagrody proporcjonalnie do rozliczenia',
            ),
            'settings.mbo.manipulate_rewards' => array(
                'pl' => 'Możliwość edycji przeliczonych punktów nagrody',
            ),
            'settings.mbo.failed_rewards' => array(
                'pl' => 'Przyznawaj punkty nagrody dla niezaliczonych celów',
            ),
            'settings.mbo.rewards_min_evaluation' => array(
                'pl' => 'Minimalny wynik oceny celu',
            ),
            'settings.mbo.rewards_points_exchange' => array(
                'pl' => 'Przeliczanie punktów nagrody',
            ),
            'settings.mbo.rewards_currency' => array(
                'pl' => 'Waluta nagrody',
            ),
            'settings.mbo.info.enabled' => array(
                'pl' => 'Włącza moduł MBO',
            ),
            'settings.mbo.info.campaigns_enabled' => array(
                'pl' => 'Włącza kampanie pomiarowe',
            ),
            'settings.mbo.info.campaigns_bonus' => array(
                'pl' => 'Przyznawaj dodatkowy bonus do punktów nagrody dla użytkowników, którzy osiągnęli wszystkie cele w kampanii. Wartość procentowa określona w tym polu odnosić się bedzię do sumy punktów nagrody uzyskanych ze wszystkich celów w kampanii.',
            ),
            'settings.mbo.info.campaigns_ignore_dates' => array(
                'pl' => 'Każdy etap kampanii wymaga wykonania określonych akcji w terminach określonych przez Administratora. Zaznaczenie tej opcji zezwala na wykonywania akcji po upływie tych terminów.',
            ),
            'settings.mbo.info.campaigns_manual' => array(
                'pl' => 'Włącza tryb ręczny w kampaniach',
            ),
            'settings.mbo.info.objectives_autofail' => array(
                'pl' => 'Automatyczne oznaczanie celów określonych terminem wykonania jako niezaliczonych po upływie terminu, jeśli nie wprowadzono wyników realizacji.',
            ),
            'settings.mbo.info.manipulate_rewards' => array(
                'pl' => 'Administratorzy mają możliwość edycji przeliczonych proporcjonalnie punktów nagrody, po ich rozliczeniu.',
            ),
            'settings.mbo.info.objectives_weights' => array(
                'pl' => 'Jeśli wagi celów są wyłączone, każdy cel ma domyślnie wagę = 1.',
            ),
            'settings.mbo.info.rewards' => array(
                'pl' => 'Włącza punkty nagrody',
            ),
            'settings.mbo.info.rewards_proportional' => array(
                'pl' => 'Przeliczaj punkty nagrody proporcjonalnie do wyniku realizacji celu.',
            ),
            'settings.mbo.info.failed_rewards' => array(
                'pl' => 'Mimo oznaczenia celu jako niezaliczony, przyznaj punkty nagrody proporcjonalnie do wyniku realizacji celu.',
            ),
            'settings.mbo.info.rewards_min_evaluation' => array(
                'pl' => 'Minimalny wynik procentowy potrzebny do otrzymania punktów nagrody. Punkty nagrody będą przeliczane proporcjonalnie powyżej zadeklarowanej wartości. Aby wyłączyć tę funkcję, ustaw wartość na 0.',
            ),
            'settings.mbo.info.rewards_points_exchange' => array(
                'pl' => 'Stosunek jednego punktu nagrody do jednego punktu w wybranej walucie',
            ),
            'settings.mbo.info.rewards_currency' => array(
                'pl' => 'Waluta przyznawania nagrody',
            ),
            'settings.users.multiple_employments' => array(
                'pl' => 'Wielozatrudnienie',
            ),
            'settings.users.info.multiple_employments' => array(
                'pl' => 'Zezwalaj na dodawanie wielu aktywnych zatrudnień dla pojedynczego profilu.',
            ),
            'settings.users.password_change_firstlogin' => array(
                'pl' => 'Wymuszaj zmianę hasła',
            ),
            'settings.users.info.password_change_firstlogin' => array(
                'pl' => 'Wymuszaj zmianę hasła po pierwszym logowaniu',
            ),
            'settings.notifications.mail_notifications' => array(
                'pl' => 'Wysyłanie powiadomień e-mail',
            ),
            'settings.notifications.info.mail_notifications' => array(
                'pl' => 'Wyłączona funkcja oznacza zablokowanie wszelkiej wysyłki powiadomień e-mail, niezależnie od preferencji użytkowników. Nie dotyczy podstawowych funkcjonalności systemu - np. reset hasła, email powitalny itp.',
            ),
            'settings.notifications.system_notifications' => array(
                'pl' => 'Wysyłanie powiadomień w systemie',
            ),
            'settings.notifications.info.system_notifications' => array(
                'pl' => 'Wyłączona funkcja oznacza zablokowanie wszelkiej wysyłki powiadomień w systemie (ikona dzwonka w górnym menu), niezależnie od preferencji użytkowników.',
            ),
            'placeholders.choose' => array(
                'pl' => 'Wybierz...',
            ),
            'placeholders.choose_date' => array(
                'pl' => 'Wybierz datę',
            ),
            'placeholders.choose_birthdate' => array(
                'pl' => 'Wybierz datę',
            ),
            'placeholders.choose_time' => array(
                'pl' => 'Wybierz godzinę',
            ),
            'placeholders.choose_datetime' => array(
                'pl' => 'Wybierz datę oraz godzinę',
            ),
            'placeholders.choose_daterange_from' => array(
                'pl' => 'Wybierz datę od...',
            ),
            'placeholders.choose_daterange_to' => array(
                'pl' => 'Wybierz datę do...',
            ),
            'from' => array(
                'pl' => '[OD]',
            ),
            'to' => array(
                'pl' => '[DO]',
            ),
            'campaigns.name' => array(
                'pl' => 'Nazwa kampanii',
            ),
            'campaigns.period' => array(
                'pl' => 'Okres pomiaru',
            ),
            'campaigns.description' => array(
                'pl' => 'Opis',
            ),
            'campaigns.date_start' => array(
                'pl' => 'Data rozpoczęcia pomiaru',
            ),
            'campaigns.date_end' => array(
                'pl' => 'Data zakończenia pomiaru',
            ),
            'campaigns.stages.definition' => array(
                'pl' => 'Tworzenie strategii i określanie celów',
            ),
            'campaigns.stages.disposition' => array(
                'pl' => 'Dysponowanie celów przez kierowników zespołów',
            ),
            'campaigns.stages.realization' => array(
                'pl' => 'Realizacja celów',
            ),
            'campaigns.stages.evaluation' => array(
                'pl' => 'Ewaluacja celów i ocena pracowników przez kierowników',
            ),
            'campaigns.stages.self_evaluation' => array(
                'pl' => 'Samoocena pracowników',
            ),
            'campaigns.stages.completed' => array(
                'pl' => 'Ocena zakończona',
            ),
            'campaigns.stages.terminated' => array(
                'pl' => 'Kampania przerwana',
            ),
            'campaigns.stages.canceled' => array(
                'pl' => 'Kampania odwołana',
            ),
            'campaigns.stages.in_progress' => array(
                'pl' => 'Kampania w toku',
            ),
            'campaigns.stages.pending' => array(
                'pl' => 'Oczekuje na rozpoczęcie pomiaru',
            ),
            'campaigns.info.period' => array(
                'pl' => 'Wprowadź unikalny reprezentatywny okres pomiaru, np. dla pomiaru co kwartał: 2023 Q3.',
            ),
            'campaigns.info.definition' => array(
                'pl' => 'Tworzenie strategii i określanie celów',
            ),
            'campaigns.info.disposition' => array(
                'pl' => 'Dysponowanie celów przez kierowników zespołów',
            ),
            'campaigns.info.realization' => array(
                'pl' => 'Realizacja celów',
            ),
            'campaigns.info.evaluation' => array(
                'pl' => 'Ewaluacja celów i ocena pracowników przez kierowników',
            ),
            'campaigns.info.self_evaluation' => array(
                'pl' => 'Samoocena pracowników',
            ),
            'campaigns.info.completed' => array(
                'pl' => 'Ocena zakończona',
            ),
            'campaigns.info.terminated' => array(
                'pl' => 'Kampania przerwana',
            ),
            'campaigns.info.canceled' => array(
                'pl' => 'Kampania odwołana',
            ),
            'campaigns.info.in_progress' => array(
                'pl' => 'Kampania w toku',
            ),
            'campaigns.info.pending' => array(
                'pl' => 'Oczekuje na rozpoczęcie pomiaru',
            ),
            'campaigns.info.draft' => array(
                'pl' => 'Kampania będzie widoczna tylko dla administratorów i nie zostanie uruchomiona automatycznie.',
            ),
            'campaigns.info.manual' => array(
                'pl' => 'Przejście pomiędzy etapami nie będzie uzależnione od dat, a od podjęcia akcji przez administratora. Opcję tą można także włączyć w trakcie trwania kampanii.',
            ),
            'campaigns.coordinators' => array(
                'pl' => 'Koordynatorzy kampanii',
            ),
            'campaigns.draft' => array(
                'pl' => 'Przechowuj jako wersję roboczą',
            ),
            'campaigns.manual' => array(
                'pl' => 'Tryb ręczny',
            ),
            'campaigns.users.add' => array(
                'pl' => 'Dodaj użytkowników',
            ),
            'users.header' => array(
                'pl' => 'Dane użytkownika',
            ),
            'users.avatar' => array(
                'pl' => 'Zdjęcie profilowe',
            ),
            'users.firstname' => array(
                'pl' => 'Imię',
            ),
            'users.lastname' => array(
                'pl' => 'Nazwisko',
            ),
            'users.email' => array(
                'pl' => 'E-mail',
            ),
            'users.gender' => array(
                'pl' => 'Płeć',
            ),
            'users.birthday' => array(
                'pl' => 'Data urodzenia',
            ),
            'users.supervisors' => array(
                'pl' => 'Bezpośredni przełożeni',
            ),
            'users.roles' => array(
                'pl' => 'Role systemowe',
            ),
            'users.roles_short' => array(
                'pl' => 'Role',
            ),
            'employments.index' => array(
                'pl' => 'Zatrudnienia',
            ),
            'employments.add' => array(
                'pl' => 'Dodaj nowe zatrudnienie',
            ),
            'employments.header' => array(
                'pl' => 'Zatrudnienie #:no',
            ),
            'employments.header_main' => array(
                'pl' => 'Zatrudnienie podstawowe',
            ),
            'employments.company' => array(
                'pl' => 'Przedsiębiorstwo',
            ),
            'employments.position' => array(
                'pl' => 'Stanowisko',
            ),
            'employments.contract' => array(
                'pl' => 'Typ umowy',
            ),
            'employments.department' => array(
                'pl' => 'Dział',
            ),
            'employments.employment' => array(
                'pl' => 'Data zatrudnienia',
            ),
            'employments.release' => array(
                'pl' => 'Data końca zatrudnienia',
            ),
            'mbo.objectives.category' => array(
                'pl' => 'Kategoria',
            ),
            'mbo.objectives.template' => array(
                'pl' => 'Szablon celu',
            ),
            'mbo.objectives.name' => array(
                'pl' => 'Nazwa celu',
            ),
            'mbo.objectives.description' => array(
                'pl' => 'Opis celu',
            ),
            'mbo.objectives.draft' => array(
                'pl' => 'Wersja robocza',
            ),
            'mbo.objectives.deadline' => array(
                'pl' => 'Termin realizacji',
            ),
            'mbo.objectives.deadline_to' => array(
                'pl' => 'Termin realizacji :term',
            ),
            'mbo.objectives.weight' => array(
                'pl' => 'Waga celu',
            ),
            'mbo.objectives.status' => array(
                'pl' => 'Status celu',
            ),
            'mbo.objectives.type' => array(
                'pl' => 'Typ celu',
            ),
            'mbo.objectives.expected' => array(
                'pl' => 'Oczekiwany wynik',
            ),
            'mbo.objectives.award' => array(
                'pl' => 'Punkty nagrody',
            ),
            'mbo.objectives.evaluation' => array(
                'pl' => 'Aktualna realizacja celu',
            ),
            'mbo.objectives.users.add' => array(
                'pl' => 'Dodaj użytkowników',
            ),
            'mbo.objectives.users.realization' => array(
                'pl' => 'Obecna realizacja celu',
            ),
            'mbo.objectives.users.evaluation' => array(
                'pl' => 'Wartość rozliczenia celu [%]',
            ),
            'mbo.objectives.users.info.realization' => array(
                'pl' => 'Wskaż numeryczną wartość realizacji celu. Jeśli przy tworzeniu celu podano oczekwiany wynik, wartość rozliczenia celu zostanie wyliczona automatycznie.',
            ),
            'mbo.objectives.users.info.evaluation' => array(
                'pl' => 'Wskaż wartość procentową realizacji celu. Jeśli przy tworzeniu celu podano oczekwiany wynik, wartość tego rozliczenia celu zostanie wyliczona automatycznie.',
            ),
            'mbo.objectives.info.deadline' => array(
                'pl' => 'Po upłynięciu tej daty, cel przypisany do użytkownika zostanie automatycznie oznaczony jako zaliczony lub niezaliczony.',
            ),
            'mbo.objectives.info.weight' => array(
                'pl' => 'Określ jaki wagowy udział ma ten cel w całej kampanii.',
            ),
            'mbo.objectives.info.expected' => array(
                'pl' => 'Określ minimalny wynik potrzebny do zaliczenia celu. W razie nieosiągnięcia wyniku, Administratorzy nadal będą mogli wymusić zaliczenie celu.',
            ),
            'mbo.objectives.info.award' => array(
                'pl' => 'W razie zaliczenia celu, na konto użytkownika wpadną określone tutaj punkty.',
            ),
            'mbo.objectives.info.draft' => array(
                'pl' => 'Cel w wersji roboczej nie zostanie udostępniony do realizacji, jest także wyłączony z raportowania.',
            ),
            'mbo.categories.name' => array(
                'pl' => 'Nazwa kategorii',
            ),
            'mbo.categories.template_count' => array(
                'pl' => 'Powiązane szablony',
            ),
            'mbo.categories.shortname' => array(
                'pl' => 'Unikalny identyfikator kategorii',
            ),
            'mbo.categories.description' => array(
                'pl' => 'Opis kategorii',
            ),
            'mbo.categories.coordinators' => array(
                'pl' => 'Koordynatorzy kategorii',
            ),
        );
    }
}
