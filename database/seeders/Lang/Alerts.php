<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Alerts extends Seeder
{
    public static function list(): array
    {
        return [
            'system.unauthorized_module' => [
                'pl' => 'Moduł, który próbujesz otworzyć został zablokowany przez administratora systemu.',
            ],
            'success.operation' => [
                'pl' => 'Operacja zakończona pomyślnie.',
            ],
            'error.invalid_role' => [
                'pl' => 'Nie posiadasz odpowiedniej roli systemowej do wykonania tej akcji.',
            ],
            'error.no_permission' => [
                'pl' => 'Nie posiadasz odpowiednich uprawnień do wykonania tej akcji.',
            ],
            'error.ajax' => [
                'pl' => 'Wystąpił błąd podczas pobierania danych z serwera, żądanie nie zostało przetworzone. Zweryfikuj swoje połączenie internetowe.',
            ],
            'error.operation' => [
                'pl' => 'Wystąpił błąd podczas wykonywania operacji.',
            ],
            'error.form' => [
                'pl' => 'W formularzu wystąpiły błędy. Popraw je i spróbuj ponownie.',
            ],
            'warning.operation' => [
                'pl' => 'Uwaga!',
            ],
            'info.maintenance' => [
                'pl' => 'Serwis jest zamknięty dla użytkowników.',
            ],
            'info.env_local' => [
                'pl' => 'Aplikacja działa w trybie lokalnym',
            ],
            'info.env_development' => [
                'pl' => 'Aplikacja uruchomiona w trybie deweloperskim. Część funkcjonalności może nie działać zgodnie z oczekiwaniami',
            ],
            'info.debugging' => [
                'pl' => 'Uwaga - Debugowanie jest włączone',
            ],
            'settings.success.cache_clear' => [
                'pl' => 'Pamięć podręczna aplikacji została pomyślnie wyczyszczona!',
            ],
            'settings.success.mail_update' => [
                'pl' => 'Dane serwera SMTP zostały zaktualizowane. Cache został automatycznie wyczyszczony.',
            ],
            'settings.success.update' => [
                'pl' => 'Ustawienia modułu zostały zaktualizowane.',
            ],
            'settings.success.general' => [
                'pl' => 'Ustawienia platformy zostały zaktualizowane.',
            ],
            'settings.error.cache_clear' => [
                'pl' => 'Podczas czyszczenia pamięci podręcznej aplikacji serwer napotkał problemy. Sprawdź uprawnienia serwera.',
            ],
            'settings.error.mail_update' => [
                'pl' => 'Dane serwera SMTP nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            ],
            'settings.error.update' => [
                'pl' => 'Ustawienia modułu nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            ],
            'settings.error.general' => [
                'pl' => 'Ustawienia platformy nie mogły zostać zaktualizowane. Wystąpił krytyczny błąd.',
            ],
            'campaigns.success.create' => [
                'pl' => 'Kampania została utworzona pomyślnie.',
            ],
            'campaigns.success.edit' => [
                'pl' => 'Kampania została pomyślnie zmodyfikowana.',
            ],
            'campaigns.success.objective_added' => [
                'pl' => 'Wskazany cel został pomyślnie dodany do Kampanii.',
            ],
            'campaigns.success.objective_deleted' => [
                'pl' => 'Cel został pomyślnie usunięty z Kampanii.',
            ],
            'campaigns.success.users_added' => [
                'pl' => 'Uzupełniono stan osobowy Kampanii pomiarowej.',
            ],
            'campaigns.success.users_deleted' => [
                'pl' => 'Użytkownik został wypisany z Kampanii.',
            ],
            'campaigns.success.terminate' => [
                'pl' => 'Kampania została pomyślnie zawieszona.',
            ],
            'campaigns.success.resume' => [
                'pl' => 'Kampania została pomyślnie odwieszona.',
            ],
            'campaigns.success.cancel' => [
                'pl' => 'Kampania została pomyślnie anulowana.',
            ],
            'campaigns.error.create' => [
                'pl' => 'Kampanie nie mogła zostać dodana. Wystąpił błąd.',
            ],
            'campaigns.error.edit' => [
                'pl' => 'Kampania nie została zmodyfikowana. W formularzu wystąpiły błędy.',
            ],
            'campaigns.error.objective_added' => [
                'pl' => 'Wskazany cel został pomyślnie dodany do Kampanii.',
            ],
            'campaigns.error.objective_deleted' => [
                'pl' => 'Cel został pomyślnie usunięty z Kampanii.',
            ],
            'campaigns.error.users_added' => [
                'pl' => 'Dane nie zostały zaktualizowane. Odśwież stronę i spróbuj ponownie.',
            ],
            'campaigns.error.users_deleted' => [
                'pl' => 'Wystąpił błąd podczas wypisywania użytkownika z Kampanii. Odśwież stronę i spróbuj ponownie.',
            ],
            'campaigns.error.terminate' => [
                'pl' => 'Kampania nie została pomyślnie zawieszona.',
            ],
            'campaigns.error.resume' => [
                'pl' => 'Kampania nie została pomyślnie odwieszona.',
            ],
            'campaigns.error.cancel' => [
                'pl' => 'Kampania nie została pomyślnie anulowana.',
            ],
            'objectives.success.users_added' => [
                'pl' => 'Uzupełniono przypisanie użytkowników do celu.',
            ],
            'objectives.success.realization_updated' => [
                'pl' => 'Dane o realizacji celu zostały zaktualizowane.',
            ],
            'objectives.error.overdued' => [
                'pl' => 'Termin realizacji tego celu minął :term',
            ],
            'objectives.error.users_added' => [
                'pl' => 'Dane nie zostały zaktualizowane. Odśwież stronę i spróbuj ponownie.',
            ],
            'objectives.error.realization_updated' => [
                'pl' => 'Dane o realizacji celu nie mogły zostać zaktualizowane. Wystąpił nieoczekiwany błąd.',
            ],
            'objectives.info.delete' => [
                'pl' => 'Usunięcie celu będzie nieodwracalne.',
            ],
            'user_objectives.success.set_passed' => [
                'pl' => 'Cel został oznaczony jako zaliczony.',
            ],
            'user_objectives.success.set_failed' => [
                'pl' => 'Cel został oznaczony jako niezaliczony.',
            ],
            'user_objectives.error.set_passed' => [
                'pl' => 'Nie można oznaczyć celu jako zaliczony.',
            ],
            'user_objectives.error.set_failed' => [
                'pl' => 'Nie można oznaczyć celu jako niezaliczony.',
            ],
            'users.success.create' => [
                'pl' => 'Nowy użytkownik został pomyślnie dodany do systemu.',
            ],
            'users.success.edit' => [
                'pl' => 'Użytkownik :name został pomyślnie zmodyfikowany.',
            ],
            'users.success.blocked' => [
                'pl' => 'Użytkownik :name został zablokowany. Nie posiada już dostępu do systemu.',
            ],
            'users.success.unblocked' => [
                'pl' => 'Użytkownik :name został odblokowany. Może spowrotem logować się do systemu.',
            ],
            'users.success.delete' => [
                'pl' => 'Użytkownik :name został usunięty z systemu.',
            ],
            'users.error.create' => [
                'pl' => 'Wystąpił błąd, użytkownik nie mógł być dodany.',
            ],
            'users.error.edit' => [
                'pl' => 'Użytkownik nie mógł zostać zmodyfikowany. Podczas operacji wystąpił nieoczekiwany błąd.',
            ],
            'users.error.delete' => [
                'pl' => 'Użytkownik :name nie mógł zostać usunięty z systemu. Podczas operacji wystąpił nieoczekiwany błąd.',
            ],
            'users.warning.user_is_root' => [
                'pl' => 'Uwaga, ten użytkownik posiada uprawnienia Roota.',
            ],
            'users.info.block' => [
                'pl' => 'Wskutek tej akcji użytkownik utraci dostęp do systemu, a jego przełożeni mogą mieć odebrane niektóre prawa.',
            ],
            'users.info.delete' => [
                'pl' => 'Usunięcie użytkownika będzie nieodwracalne.',
            ],
            'employments.success.create' => [
                'pl' => 'Nowe zatrudnienie zostało pomyślnie dodane.',
            ],
            'employments.success.edit' => [
                'pl' => 'Zatrudnienie zostało pomyślnie zmodyfikowane.',
            ],
            'employments.success.delete' => [
                'pl' => 'Zatrudnienie zostało pomyślnie usunięte.',
            ],
            'employments.error.create' => [
                'pl' => 'Nowe zatrudnienie nie mógło zostać dodane. Wystąpił błąd.',
            ],
            'employments.error.edit' => [
                'pl' => 'Zatrudnienie nie mógło zostać zmodyfikowane. Wystąpił błąd.',
            ],
            'employments.error.delete' => [
                'pl' => 'Zatrudnienie nie mógło zostać usunięte. Wystąpił błąd.',
            ],
            'objective_template.success.create' => [
                'pl' => 'Nowy szablon celu został pomyślnie dodany.',
            ],
            'objective_template.success.edit' => [
                'pl' => 'Szablon celu został pomyślnie zmodyfikowany.',
            ],
            'objective_template.success.delete' => [
                'pl' => 'Szablon celu został pomyślnie usunięty.',
            ],
            'objective_template.error.create' => [
                'pl' => 'Nowy szablon celu nie mógł zostać dodany. Wystąpił błąd.',
            ],
            'objective_template.error.edit' => [
                'pl' => 'Szablon celu nie został zmodyfikowany. Wystąpił błąd.',
            ],
            'objective_template.error.delete' => [
                'pl' => 'Szablon celu niestety nie został usunięty. Wystąpił błąd.',
            ],
            'objective_categories.success.create' => [
                'pl' => 'Nowa kategoria MBO została pomyślnie dodana.',
            ],
            'objective_categories.success.edit' => [
                'pl' => 'Kategoria MBO została pomyślnie zmodyfikowana.',
            ],
            'objective_categories.success.delete' => [
                'pl' => 'Kategoria MBO została pomyślnie usunięta.',
            ],
            'objective_categories.error.create' => [
                'pl' => 'Nowa kategoria MBO nie mógła zostać dodana. Wystąpił błąd.',
            ],
            'objective_categories.error.edit' => [
                'pl' => 'Kategoria MBO nie została zmodyfikowana. Wystąpił błąd.',
            ],
            'objective_categories.error.delete' => [
                'pl' => 'Kategoria MBO niestety nie została usunięta. Wystąpił błąd.',
            ],
            'objective_categories.info.delete' => [
                'pl' => 'Usunięcie kategorii będzie nieodwracalne. Razem z nią usunięte zostaną wszystkie powiązane cele.',
            ],
            'datatables.save_columns.error_data' => [
                'pl' => 'Nie wykryto nowych danych dotyczących wyświetlania kolumn w tabeli. Zmiany nie zostały zapisane.',
            ],
            'datatables.save_columns.error' => [
                'pl' => 'Nie można było zapisać nowych danych dotyczących kolumn w tabeli. Wystąpił błąd.',
            ],
        ];
    }
}
