<?php

namespace Database\Seeders\Lang;

use Illuminate\Database\Seeder;

class Menus extends Seeder
{
    public static function list(): array
    {
        return [
            'dashboard' => [
                'pl' => 'Pulpit',
                'en' => 'Dashboard',
            ],
            'admin_panel' => [
                'pl' => 'Panel administracyjny',
                'en' => 'Admin panel',
            ],
            'reports.index' => [
                'pl' => 'Raporty',
                'en' => 'Reports',
            ],
            'notifications.index' => [
                'pl' => 'Powiadomienia',
                'en' => 'Notifications',
            ],
            'edit_profile' => [
                'pl' => 'Edytuj profil',
                'en' => 'Edit profile',
            ],
            'activity' => [
                'pl' => 'Aktywność',
                'en' => 'Activity',
            ],
            'my_results' => [
                'pl' => 'Moje wyniki',
                'en' => 'My results',
            ],
            'preferences' => [
                'pl' => 'Preferencje',
                'en' => 'Preferences',
            ],
            'logout' => [
                'pl' => 'Wyloguj',
                'en' => 'Logout',
            ],
            'login' => [
                'pl' => 'Zaloguj się',
                'en' => 'Login',
            ],
            'forgot_password' => [
                'pl' => 'Przypomnij hasło',
                'en' => 'Forgot password',
            ],
            'remember_me' => [
                'pl' => 'Zapamiętaj mnie',
                'en' => 'Remember me',
            ],
            'impersonation_leave' => [
                'pl' => 'Wyloguj się jako',
                'en' => 'Logout as',
            ],
            'impersonated_by' => [
                'pl' => ':name podszywa się',
                'en' => ':name impersonated',
            ],
            'my_objectives.index' => [
                'pl' => 'Moje cele',
                'en' => 'My objectives',
            ],
            'profile.index' => [
                'pl' => 'Profil',
                'en' => 'Profile',
            ],
            'profile.edit' => [
                'pl' => 'Edytuj',
                'en' => 'Edit',
            ],
            'profile.reset' => [
                'pl' => 'Reset hasła',
                'en' => 'Reset password',
            ],
            'profile.personal_data' => [
                'pl' => 'Dane personalne',
                'en' => 'Personal data',
            ],
            'profile.settings' => [
                'pl' => 'Ustawienia konta',
                'en' => 'Account settings',
            ],
            'profile.logs' => [
                'pl' => 'Twoja aktywność',
                'en' => 'Your activity',
            ],
            'settings.index' => [
                'pl' => 'Ustawienia',
                'en' => 'Settings',
            ],
            'settings.general.index' => [
                'pl' => 'Główne',
                'en' => 'General',
            ],
            'settings.modules.index' => [
                'pl' => 'Moduły',
                'en' => 'Modules',
            ],
            'settings.integrations.index' => [
                'pl' => 'Integracje',
                'en' => 'Integrations',
            ],
            'settings.notifications.index' => [
                'pl' => 'Powiadomienia',
                'en' => 'Notifications',
            ],
            'settings.server.index' => [
                'pl' => 'Serwer',
                'en' => 'Server',
            ],
            'settings.logs.index' => [
                'pl' => 'Logi',
                'en' => 'Logs',
            ],
            'settings.help.index' => [
                'pl' => 'Pomoc',
                'en' => 'Help',
            ],
            'settings.organization.index' => [
                'pl' => 'Struktura organizacyjna',
                'en' => 'Organization structure',
            ],
            'settings.organization.companies.index' => [
                'pl' => 'Przedsiębiorstwa',
                'en' => 'Companies',
            ],
            'settings.organization.departments.index' => [
                'pl' => 'Działy',
                'en' => 'Departments',
            ],
            'settings.organization.positions.index' => [
                'pl' => 'Stanowiska',
                'en' => 'Positions',
            ],
            'settings.organization.contracts.index' => [
                'pl' => 'Typy kontraktów',
                'en' => 'Contract types',
            ],
            'settings.creator.index' => [
                'pl' => 'Kreator struktury',
                'en' => 'Creator structure',
            ],
            'settings.teams.index' => [
                'pl' => 'Zespoły',
                'en' => 'Teams',
            ],
            'mbo.index' => [
                'pl' => 'Zarządzanie celami',
                'en' => 'Manage objectives',
            ],
            'objectives.index' => [
                'pl' => 'Cele',
                'en' => 'Objectives',
            ],
            'objectives.create' => [
                'pl' => 'Tworzenie celu',
                'en' => 'Create objective',
            ],
            'objectives.edit' => [
                'pl' => 'Modyfikacja celu',
                'en' => 'Edit objective',
            ],
            'templates.index' => [
                'pl' => 'Szablony celów',
                'en' => 'Objective templates',
            ],
            'templates.create' => [
                'pl' => 'Tworzenie szablonu celu',
                'en' => 'Create objective template',
            ],
            'templates.edit' => [
                'pl' => 'Modyfikacja szablonu celu',
                'en' => 'Edit objective template',
            ],
            'categories.index' => [
                'pl' => 'Kategorie celów',
                'en' => 'Objective categories',
            ],
            'categories.create' => [
                'pl' => 'Tworzenie kategorii MBO',
                'en' => 'Create objective category',
            ],
            'categories.edit' => [
                'pl' => 'Modyfikacja kategorii MBO',
                'en' => 'Edit objective category',
            ],
            'campaigns.index' => [
                'pl' => 'Kampanie Pomiarowe',
                'en' => 'Campaigns',
            ],
            'campaigns.create' => [
                'pl' => 'Tworzenie nowej kampanii pomiarowej',
                'en' => 'Create campaign',
            ],
            'campaigns.edit' => [
                'pl' => 'Edycja kampanii',
                'en' => 'Edit campaign',
            ],
            'users.index' => [
                'pl' => 'Użytkownicy',
                'en' => 'Users',
            ],
            'users.edit' => [
                'pl' => 'Edycja użytkownika',
                'en' => 'Edit user',
            ],
            'users.create' => [
                'pl' => 'Tworzenie użytkownika',
                'en' => 'Create user',
            ],
            'users.show' => [
                'pl' => 'Profil użytkownika',
                'en' => 'User profile',
            ],
            'info.profile.logs' => [
                'pl' => 'Strona przedstawia całą Twoją aktywność, jaka jest mierzona przez system.',
                'en' => 'This page displays your entire activity, which is monitored by the system.',
            ],
        ];
    }
}
