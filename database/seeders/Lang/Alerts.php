<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Alerts extends Seeder
{
    public static function list(): array
    {
        return array(
            'system.unauthorized_module' => array(
                'pl' => 'Moduł, który próbujesz otworzyć został zablokowany przez administratora systemu.',
            ),
            'success.operation' => array(
                'pl' => 'Operacja zakończona pomyślnie.',
            ),
            'error.invalid_role' => array(
                'pl' => 'Nie posiadasz odpowiedniej roli systemowej do wykonania tej akcji.',
            ),
            'error.no_permission' => array(
                'pl' => 'Nie posiadasz odpowiednich uprawnień do wykonania tej akcji.',
            ),
            'error.ajax' => array(
                'pl' => 'Wystąpił błąd podczas pobierania danych z serwera, żądanie nie zostało przetworzone. Zweryfikuj swoje połączenie internetowe.',
            ),
            'error.operation' => array(
                'pl' => 'Wystąpił błąd podczas wykonywania operacji.',
            ),
            'error.form' => array(
                'pl' => 'W formularzu wystąpiły błędy. Popraw je i spróbuj ponownie.',
            ),
            'warning.operation' => array(
                'pl' => 'Uwaga!',
            ),
            'info.maintenance' => array(
                'pl' => 'Serwis jest zamknięty dla użytkowników.',
            ),
            'info.env_local' => array(
                'pl' => 'Aplikacja działa w trybie lokalnym',
            ),
            'info.env_development' => array(
                'pl' => 'Aplikacja uruchomiona w trybie deweloperskim. Część funkcjonalności może nie działać zgodnie z oczekiwaniami',
            ),
            'info.debugging' => array(
                'pl' => 'Uwaga - Debugowanie jest włączone',
            ),
            'settings.success.cache_clear' => array(
                'pl' => 'Pamięć podręczna aplikacji została pomyślnie wyczyszczona!',
            ),
            'settings.success.mail_update' => array(
                'pl' => 'Dane serwera SMTP zostały zaktualizowane. Cache został automatycznie wyczyszczony.',
            ),
            'settings.success.update' => array(
                'pl' => 'Ustawienia modułu zostały zaktualizowane.',
            ),
            'settings.success.general' => array(
                'pl' => 'Ustawienia platformy zostały zaktualizowane.',
            ),
            'settings.error.cache_clear' => array(
                'pl' => 'Podczas czyszczenia pamięci podręcznej aplikacji serwer napotkał problemy. Sprawdź uprawnienia serwera.',
            ),
            'settings.error.mail_update' => array(
                'pl' => 'Dane serwera SMTP nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            ),
            'settings.error.update' => array(
                'pl' => 'Ustawienia modułu nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            ),
            'settings.error.general' => array(
                'pl' => 'Ustawienia platformy nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            ),
            'campaigns.success.create' => array(
                'pl' => 'Kampania została utworzona pomyślnie.',
            ),
            'campaigns.success.edit' => array(
                'pl' => 'Kampania została pomyślnie zmodyfikowana.',
            ),
            'campaigns.success.objective_added' => array(
                'pl' => 'Wskazany cel został pomyślnie dodany do Kampanii.',
            ),
            'campaigns.success.objective_deleted' => array(
                'pl' => 'Cel został pomyślnie usunięty z Kampanii.',
            ),
            'campaigns.success.users_added' => array(
                'pl' => 'Uzupełniono stan osobowy Kampanii pomiarowej.',
            ),
            'campaigns.success.users_deleted' => array(
                'pl' => 'Użytkownik został wypisany z Kampanii.',
            ),
            'campaigns.success.terminate' => array(
                'pl' => 'Kampania została pomyślnie zawieszona.',
            ),
            'campaigns.success.resume' => array(
                'pl' => 'Kampania została pomyślnie odwieszona.',
            ),
            'campaigns.success.cancel' => array(
                'pl' => 'Kampania została pomyślnie anulowana.',
            ),
            'campaigns.error.create' => array(
                'pl' => 'Kampanie nie mogła zostać dodana. Wystąpił błąd.',
            ),
            'campaigns.error.edit' => array(
                'pl' => 'Kampania nie została zmodyfikowana. W formularzu wystąpiły błędy.',
            ),
            'campaigns.error.objective_added' => array(
                'pl' => 'Wskazany cel został pomyślnie dodany do Kampanii.',
            ),
            'campaigns.error.objective_deleted' => array(
                'pl' => 'Cel został pomyślnie usunięty z Kampanii.',
            ),
            'campaigns.error.users_added' => array(
                'pl' => 'Dane nie zostały zaktualizowane. Odśwież stronę i spróbuj ponownie.',
            ),
            'campaigns.error.users_deleted' => array(
                'pl' => 'Wystąpił błąd podczas wypisywania użytkownika z Kampanii. Odśwież stronę i spróbuj ponownie.',
            ),
            'campaigns.error.terminate' => array(
                'pl' => 'Kampania nie została pomyślnie zawieszona.',
            ),
            'campaigns.error.resume' => array(
                'pl' => 'Kampania nie została pomyślnie odwieszona.',
            ),
            'campaigns.error.cancel' => array(
                'pl' => 'Kampania nie została pomyślnie anulowana.',
            ),
            'objectives.success.users_added' => array(
                'pl' => 'Uzupełniono przypisanie użytkowników do celu.',
            ),
            'objectives.success.realization_updated' => array(
                'pl' => 'Dane o realizacji celu zostały zaktualizowane.',
            ),
            'objectives.error.overdued' => array(
                'pl' => 'Termin realizacji tego celu minął :term',
            ),
            'objectives.error.users_added' => array(
                'pl' => 'Dane nie zostały zaktualizowane. Odśwież stronę i spróbuj ponownie.',
            ),
            'objectives.error.realization_updated' => array(
                'pl' => 'Dane o realizacji celu nie mogły zostać zaktualizowane. Wystąpił nieoczekiwany błąd.',
            ),
            'objectives.info.delete' => array(
                'pl' => 'Usunięcie celu będzie nieodwracalne.',
            ),
            'user_objectives.success.set_passed' => array(
                'pl' => 'Cel został oznaczony jako zaliczony.',
            ),
            'user_objectives.success.set_failed' => array(
                'pl' => 'Cel został oznaczony jako niezaliczony.',
            ),
            'user_objectives.error.set_passed' => array(
                'pl' => 'Nie można oznaczyć celu jako zaliczony.',
            ),
            'user_objectives.error.set_failed' => array(
                'pl' => 'Nie można oznaczyć celu jako niezaliczony.',
            ),
            'users.success.create' => array(
                'pl' => 'Nowy użytkownik został pomyślnie dodany do systemu.',
            ),
            'users.success.edit' => array(
                'pl' => 'Użytkownik :name został pomyślnie zmodyfikowany.',
            ),
            'users.success.blocked' => array(
                'pl' => 'Użytkownik :name został zablokowany. Nie posiada już dostępu do systemu.',
            ),
            'users.success.unblocked' => array(
                'pl' => 'Użytkownik :name został odblokowany. Może spowrotem logować się do systemu.',
            ),
            'users.success.delete' => array(
                'pl' => 'Użytkownik :name został usunięty z systemu.',
            ),
            'users.error.create' => array(
                'pl' => 'Wystąpił błąd, użytkownik nie mógł być dodany.',
            ),
            'users.error.edit' => array(
                'pl' => 'Użytkownik nie mógł zostać zmodyfikowany. Podczas operacji wystąpił nieoczekiwany błąd.',
            ),
            'users.error.delete' => array(
                'pl' => 'Użytkownik :name nie mógł zostać usunięty z systemu. Podczas operacji wystąpił nieoczekiwany błąd.',
            ),
            'users.warning.user_is_root' => array(
                'pl' => 'Uwaga, ten użytkownik posiada uprawnienia Roota.',
            ),
            'users.info.block' => array(
                'pl' => 'Wskutek tej akcji użytkownik utraci dostęp do systemu, a jego przełożeni mogą mieć odebrane niektóre prawa.',
            ),
            'users.info.delete' => array(
                'pl' => 'Usunięcie użytkownika będzie nieodwracalne.',
            ),
            'employments.success.create' => array(
                'pl' => 'Nowe zatrudnienie zostało pomyślnie dodane.',
            ),
            'employments.success.edit' => array(
                'pl' => 'Zatrudnienie zostało pomyślnie zmodyfikowane.',
            ),
            'employments.success.delete' => array(
                'pl' => 'Zatrudnienie zostało pomyślnie usunięte.',
            ),
            'employments.error.create' => array(
                'pl' => 'Nowe zatrudnienie nie mógło zostać dodane. Wystąpił błąd.',
            ),
            'employments.error.edit' => array(
                'pl' => 'Zatrudnienie nie mógło zostać zmodyfikowane. Wystąpił błąd.',
            ),
            'employments.error.delete' => array(
                'pl' => 'Zatrudnienie nie mógło zostać usunięte. Wystąpił błąd.',
            ),
            'objective_template.success.create' => array(
                'pl' => 'Nowy szablon celu został pomyślnie dodany.',
            ),
            'objective_template.success.edit' => array(
                'pl' => 'Szablon celu został pomyślnie zmodyfikowany.',
            ),
            'objective_template.success.delete' => array(
                'pl' => 'Szablon celu został pomyślnie usunięty.',
            ),
            'objective_template.error.create' => array(
                'pl' => 'Nowy szablon celu nie mógł zostać dodany. Wystąpił błąd.',
            ),
            'objective_template.error.edit' => array(
                'pl' => 'Szablon celu nie został zmodyfikowany. Wystąpił błąd.',
            ),
            'objective_template.error.delete' => array(
                'pl' => 'Szablon celu niestety nie został usunięty. Wystąpił błąd.',
            ),
            'objective_categories.success.create' => array(
                'pl' => 'Nowa kategoria MBO została pomyślnie dodana.',
            ),
            'objective_categories.success.edit' => array(
                'pl' => 'Kategoria MBO została pomyślnie zmodyfikowana.',
            ),
            'objective_categories.success.delete' => array(
                'pl' => 'Kategoria MBO została pomyślnie usunięta.',
            ),
            'objective_categories.error.create' => array(
                'pl' => 'Nowa kategoria MBO nie mógła zostać dodana. Wystąpił błąd.',
            ),
            'objective_categories.error.edit' => array(
                'pl' => 'Kategoria MBO nie została zmodyfikowana. Wystąpił błąd.',
            ),
            'objective_categories.error.delete' => array(
                'pl' => 'Kategoria MBO niestety nie została usunięta. Wystąpił błąd.',
            ),
            'objective_categories.info.delete' => array(
                'pl' => 'Usunięcie kategorii będzie nieodwracalne. Razem z nią usunięte zostaną wszystkie powiązane cele.',
            ),
            'datatables.save_columns.error_data' => array(
                'pl' => 'Nie wykryto nowych danych dotyczących wyświetlania kolumn w tabeli. Zmiany nie zostały zapisane.',
            ),
            'datatables.save_columns.error' => array(
                'pl' => 'Nie można było zapisać nowych danych dotyczących kolumn w tabeli. Wystąpił błąd.',
            ),
        );
    }
}
